<?php

namespace App\Http\Controllers;

use Exception;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Payment;
use App\Models\Student;
use Midtrans\Notification;
use Illuminate\Http\Request;
use App\DataTables\PaymentDataTable;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($uuid)

    {
        $student = Student::where('user_id', Auth::user()->id)->first();
        $payment = Payment::where('student_id', $student->id)->get();
        $countpayment = Payment::where('student_id', $student->id)->count();
        $pending = Payment::where('student_id', $student->id)->where('jenis_bayar', 'tp')->first();
        $student = Student::where('uuid', $uuid)->first();
        return view('student.payment.index', compact('student', 'payment', 'countpayment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function bayar($id)
    {
        $payment = Payment::find($id);
        //dd($payment);
        Config::$serverKey = config('services.midtrans.severKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');


        $params = array(
            'transaction_details' => array(
                'order_id' => $payment->order_id,
                'gross_amount' => $payment->gross_amount,
            ),
            'item_details' => array(
                [
                    'id' => 'a1',
                    'price' =>  $payment->gross_amount,
                    'quantity' => 1,
                    'name' =>  $payment->jenis_bayar
                ]
            ),
            'customer_details' => array(
                'first_name' => $payment->name,
                'last_name' => '',
                'email' => Auth::user()->email,
                'phone' => Auth::user()->nohp,
            ),
            'vtweb' => [],
        );

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($params)->redirect_url;

            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function callback(Request $request)
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        $notif = new \Midtrans\Notification();

        $transaction = $notif->transaction_status;
        $type = $notif->payment_type;
        $status_code = $notif->status_code;
        $order_id = $notif->order_id;
        $fraud = $notif->fraud_status;
        $signature_key = $notif->signature_key;
        $payment = Payment::where('order_id', $order_id)->first();
        $signature = hash('sha512', $payment->order_id . 200 . $payment->gross_amount . env('MIDTRANS_SERVER_KEY'));

        if ($signature != $signature_key) {
            return abort(404);
        }

        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // TODO merchant should decide whether this transaction is authorized or not in MAP
                    echo "Transaction order_id: " . $order_id . " is challenged by FDS";
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    echo "Transaction order_id: " . $order_id . " successfully captured using " . $type;
                }
            }
        } else if ($transaction == 'settlement') {
            // TODO set payment status in merchant's database to 'Settlement'
            $payment = Payment::where('order_id', $order_id)->first();
            $payment->update([
                'transaction_status' => $transaction,
            ]);
        } else if ($transaction == 'pending') {
            // TODO set payment status in merchant's database to 'Pending'
            echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
        } else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Payment::create([
            'student_id' => $request->id,
            'name' => $request->name,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'jenis_bayar' => $request->jenisbayar,
            'gross_amount' => $request->nominal,
            'order_id' => rand(),
            'transaction_status' => 'PENDING',
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}

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

        $notification = new \Midtrans\Notification();

        // Buat instance midtrans notification
        //$notification = new Notification();
        dd($notification);

        // Assign ke variable untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        $transaction = Payment::findOrFail($order_id);

        // Handle notification status midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->status = 'PENDING';
                } else {
                    $transaction->status = 'SUCCESS';
                }
            }
        } else if ($status == 'settlement') {
            $transaction->status = 'SUCCESS';
        } else if ($status == 'pending') {
            $transaction->status = 'PENDING';
        } else if ($status == 'deny') {
            $transaction->status = 'CANCELLED';
        } else if ($status == 'expire') {
            $transaction->status = 'CANCELLED';
        } else if ($status == 'cancel') {
            $transaction->status = 'CANCELLED';
        }

        // Simpan transaksi
        $transaction->save();
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

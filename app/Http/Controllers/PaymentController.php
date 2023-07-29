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
use App\Models\TempPayment;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $student = Student::where('user_id', auth()->id())->first();
        $payment = Payment::where('student_id', $student->id)->get();
        $countpayment = Payment::where('student_id', $student->id)->count();
        $pending = Payment::where('student_id', $student->id)->where('jenis_bayar', 'tp')->first();
        return view('student.payment.index', compact('student', 'payment', 'countpayment', 'pending'));
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
        Config::$serverKey = 'SB-Mid-server--_hpiUHhQo8miMGcnrzcAoxw';
        Config::$isProduction = false;
        // Config::$isSanitized = config('services.midtrans.isSanitized');
        // Config::$is3ds = config('services.midtrans.is3ds');

        // \Midtrans\Config::$isProduction = false;
        // \Midtrans\Config::$serverKey = 'SB-Mid-server--_hpiUHhQo8miMGcnrzcAoxw';
        // $notif = new \Midtrans\Notification();
        // dd($notif);

        // $transaction = $notif->transaction_status;
        // $type = $notif->payment_type;
        // $status_code = $notif->status_code;
        // $order_id = $notif->order_id;
        // $fraud = $notif->fraud_status;
        // $signature_key = $notif->signature_key;
        // $payment = Payment::where('order_id', $order_id)->first();
        // $signature = hash('sha512', $payment->order_id . 200 . $payment->gross_amount . 'SB-Mid-server--_hpiUHhQo8miMGcnrzcAoxw');

        // if ($signature != $signature_key) {
        //     return abort(404);
        // }



        // Buat instance midtrans notification
        $notification = new Notification();

        // Assign ke variable untuk memudahkan coding
        $status = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $order_id = $notification->order_id;

        // Cari transaksi berdasarkan ID
        $transaction = Payment::where('order_id', $order_id)->first();

        // Handle notification status midtrans
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->transaction_status = 'PENDING';
                } else {
                    $transaction->transaction_status = 'SUCCESS';
                }
            }
        } else if ($status == 'settlement') {
            $transaction->transaction_status = 'SUCCESS';
        } else if ($status == 'pending') {
            $transaction->transaction_status = 'PENDING';
        } else if ($status == 'deny') {
            $transaction->transaction_status = 'CANCELLED';
        } else if ($status == 'expire') {
            $transaction->transaction_status = 'CANCELLED';
        } else if ($status == 'cancel') {
            $transaction->transaction_status = 'CANCELLED';
        }

        // Simpan transaksi
        $transaction->save();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        \Midtrans\Config::$serverKey = 'SB-Mid-server--_hpiUHhQo8miMGcnrzcAoxw';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $request->nominal,
            ),
            'item_details' => array(
                [
                    'id' => 'a1',
                    'price' =>  $request->nominal,
                    'quantity' => 1,
                    'name' =>  $request->jenis_bayar
                ]
            ),
            'customer_details' => array(
                'first_name' => $request->name,
                'last_name' => '',
                'email' => Auth::user()->email,
                'phone' => Auth::user()->nohp,
            ),
        );
        $student = Student::where('user_id', auth()->id())->first();
        TempPayment::create([
            'student_id' => $student->id,
            'name' => $request->name,
            'jenis_bayar' => $request->jenis_bayar,
            'nominal' => $request->nominal,
            'email' => $request->email,
            'nohp' => $request->nohp,
        ]);
        $temppayment = TempPayment::where('student_id', $student->id)->first();
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('student.payment.create', compact('params', 'student', 'snapToken', 'temppayment'));
    }

    public function checkout(Request $request, $id)
    {
        $json = json_decode($request->get('json'));
        //dd($json);
        $student = Student::where('user_id', Auth::user()->id)->first();
        $temp = TempPayment::find($id);
        Payment::create([
            'student_id' => $student->id,
            'transaction_status' => $json->transaction_status,
            'name' => $temp->name,
            'email' => $temp->email,
            'nohp' => $temp->nohp,
            'jenis_bayar' => $temp->jenis_bayar,
            'transaction_id' => $json->transaction_id,
            'order_id' => $json->order_id,
            'gross_amount' => $json->gross_amount,
            'payment_type' => $json->payment_type,
            'transaction_time' => $json->transaction_time,
            'status_message' => $json->status_message,
            'pdf_url' => $json->pdf_url,
        ]);
        TempPayment::find($id)->delete();
        return redirect()->route('payment.index');
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

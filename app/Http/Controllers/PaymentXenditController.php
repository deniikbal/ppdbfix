<?php

namespace App\Http\Controllers;

use App\Jobs\NotifCallback;
use App\Jobs\NotifPayment;
use App\Models\payment_xendit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Xendit\Xendit;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PaymentXenditController extends Controller
{

    public function createinvoice(Request $request)
    {
        Xendit::setApiKey(env('SECRET_API_KEY'));
        $kode_bayar = IdGenerator::generate(['table' => 'xendit_payments', 'field' => 'external_id', 'length' => 10, 'prefix' => ('INV-')]);
        $params = [
            'external_id' => $kode_bayar,
            'amount' => $request->nominal,
            'description' => $request->jenis_bayar,
            'invoice_duration' => 86400,
            'success_redirect_url' => route('payment.index'),
            'currency' => 'IDR',
            'fees' => [
                [
                    'type' => 'ADMIN',
                    'value' => 5000
                ]
            ]
        ];

        $createInvoice = \Xendit\Invoice::create($params);
        //return response()->json(['data' => $createInvoice['invoice_url']]);
        $payment = payment_xendit::create([
            'student_id' => $request->id,
            'no_handphone' => $request->nohp,
            'external_id' => $createInvoice['external_id'],
            'status' => $createInvoice['status'],
            'amount' => $createInvoice['amount'],
            'expiry_date' => $createInvoice['expiry_date'],
            'invoice_url' => $createInvoice['invoice_url'],
            'description' => $createInvoice['description'],
        ]);

        //dd($payment);
        NotifPayment::dispatch($payment);
        return redirect()->back();
    }

    public function callback(Request $request)
    {
        Xendit::setApiKey(env('SECRET_API_KEY'));
        $getInvoice = \Xendit\Invoice::retrieve($request->id);
        $payment = payment_xendit::where('external_id', $request->external_id)->firstOrFail();

        if ($payment->status == 'settled') {
            return response()->json(['data' => 'payment sukses']);
        }

        $payment->status = $getInvoice['status'];
        $payment->save();

        NotifCallback::dispatch($payment, $getInvoice);

        return response()->json(['data' => 'update sukses']);
    }
}

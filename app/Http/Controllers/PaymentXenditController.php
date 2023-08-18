<?php

namespace App\Http\Controllers;

use App\Models\payment_xendit;
use Illuminate\Http\Request;
use Xendit\Xendit;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PaymentXenditController extends Controller
{

    public function createinvoice(Request $request)
    {
        Xendit::setApiKey('xnd_development_TRgulyb0HGsABsXzZPq6yqq1KXxsEfYnkDuKkLrTXMdeMY3vtIF8UXBsFcRJ');
        $kode_bayar = IdGenerator::generate(['table' => 'xendit_payments', 'field' => 'external_id', 'length' => 10, 'prefix' => ('INV-')]);
        $params = [
            'external_id' => $kode_bayar,
            'amount' => $request->nominal,
            'description' => $request->jenis_bayar,
            'invoice_duration' => 30,
            'customer_notification_preference' => [
                'invoice_created' => [
                    'whatsapp',
                ],
                'invoice_reminder' => [
                    'whatsapp',
                ],
                'invoice_paid' => [
                    'whatsapp',
                ],
                'invoice_expired' => [
                    'whatsapp',
                ]
            ],
            'success_redirect_url' => 'http://127.0.0.1:8000/payment',
            'currency' => 'IDR',
            'fees' => [
                [
                    'type' => 'ADMIN',
                    'value' => 5000
                ]
            ]
        ];

        $createInvoice = \Xendit\Invoice::create($params);
        payment_xendit::create([
            'student_id' => $request->id,
            'external_id' => $createInvoice['external_id'],
            'status' => $createInvoice['status'],
            'amount' => $createInvoice['amount'],
            'expiry_date' => $createInvoice['expiry_date'],
            'invoice_url' => $createInvoice['invoice_url'],
            'description' => $createInvoice['description'],
        ]);
        return redirect()->back();
    }

    public function callback(Request $request)
    {
        Xendit::setApiKey('xnd_development_TRgulyb0HGsABsXzZPq6yqq1KXxsEfYnkDuKkLrTXMdeMY3vtIF8UXBsFcRJ');
        $getInvoice = \Xendit\Invoice::retrieve($request->id);
        $payment = payment_xendit::where('external_id', $request->external_id)->firstOrFail();

        if ($payment->status == 'settled') {
            return response()->json(['data' => 'payment sukses']);
        }

        $payment->status = $getInvoice['status'];
        $payment->save();
        return response()->json(['data' => 'update sukses']);
    }
}

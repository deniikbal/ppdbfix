<?php

namespace App\Http\Controllers;

use App\Models\payment_xendit;
use Illuminate\Http\Request;
use Xendit\Xendit;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PaymentXenditController extends Controller
{
    public function __construct()
    {
        Xendit::setApiKey('xnd_development_TRgulyb0HGsABsXzZPq6yqq1KXxsEfYnkDuKkLrTXMdeMY3vtIF8UXBsFcRJ');
    }

    public function create(Request $request)
    {

        $kode_bayar = IdGenerator::generate(['table' => 'students', 'field' => 'nodaftar', 'length' => 10, 'prefix' => ('INV-')]);
        Xendit::setApiKey('xnd_development_TRgulyb0HGsABsXzZPq6yqq1KXxsEfYnkDuKkLrTXMdeMY3vtIF8UXBsFcRJ');

        $params = [
            'external_id' => 'demo_1475801962607',
            'amount' => 50000,
            'description' => 'Invoice Demo #123',
            'invoice_duration' => 86400,
            'customer' => [
                'given_names' => 'John',
                'surname' => 'Doe',
                'email' => 'johndoe@example.com',
                'mobile_number' => '+6287774441111',
                'addresses' => [
                    [
                        'city' => 'Jakarta Selatan',
                        'country' => 'Indonesia',
                        'postal_code' => '12345',
                        'state' => 'Daerah Khusus Ibukota Jakarta',
                        'street_line1' => 'Jalan Makan',
                        'street_line2' => 'Kecamatan Kebayoran Baru'
                    ]
                ]
            ],
            'customer_notification_preference' => [
                'invoice_created' => [
                    'whatsapp',
                    'sms',
                    'email',
                    'viber'
                ],
                'invoice_reminder' => [
                    'whatsapp',
                    'sms',
                    'email',
                    'viber'
                ],
                'invoice_paid' => [
                    'whatsapp',
                    'sms',
                    'email',
                    'viber'
                ],
                'invoice_expired' => [
                    'whatsapp',
                    'sms',
                    'email',
                    'viber'
                ]
            ],
            'success_redirect_url' => 'https=>//www.google.com',
            'failure_redirect_url' => 'https=>//www.google.com',
            'currency' => 'IDR',
            'items' => [
                [
                    'name' => 'Air Conditioner',
                    'quantity' => 1,
                    'price' => 100000,
                    'category' => 'Electronic',
                    'url' => 'https=>//yourcompany.com/example_item'
                ]
            ],
            'fees' => [
                [
                    'type' => 'ADMIN',
                    'value' => 5000
                ]
            ]
        ];

        $createInvoice = \Xendit\Invoice::create($params);
        var_dump($createInvoice);
        // return response()->json(['data' => $createInvoice['invoice_url']]);
    }

    public function createinvoice(Request $request)
    {
        Xendit::setApiKey('xnd_development_TRgulyb0HGsABsXzZPq6yqq1KXxsEfYnkDuKkLrTXMdeMY3vtIF8UXBsFcRJ');
        $kode_bayar = IdGenerator::generate(['table' => 'xendit_payments', 'field' => 'external_id', 'length' => 10, 'prefix' => ('INV-')]);
        $params = [
            'external_id' => $kode_bayar,
            'amount' => $request->nominal,
            'description' => $request->jenis_bayar,
            'invoice_duration' => 86400,
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
}

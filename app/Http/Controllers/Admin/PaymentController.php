<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PaymentDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function Termwind\render;

class PaymentController extends Controller
{
    public function adminpayment(PaymentDataTable $paymentDataTable)
    {
        return $paymentDataTable->render('admin.payment.index');


    }
}

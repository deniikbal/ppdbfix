<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PaymentDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use function Termwind\render;

class PaymentController extends Controller
{
    public function index(PaymentDataTable $dataTable)
    {
        return $dataTable->render('admin.payment.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PaymentDataTable;
use App\Http\Controllers\Controller;
use App\Models\payment_xendit;
use Illuminate\Http\Request;
use function Termwind\render;

class PaymentController extends Controller
{
    public function index(PaymentDataTable $dataTable)
    {
        $title = 'Payment';
        return $dataTable->render('admin.payment.index', compact('title'));
    }

    public function editpaymentadmin($id)
    {
        $title = 'Edit Payment';
        $pay = payment_xendit::with('student')->find($id);
        return view('admin.payment.show', compact('pay', 'title'));

    }

    public function updatepayadmin(Request $request, $id)
    {
        $pay = payment_xendit::findorfail($id);
        $pay->update([
            'status' => $request->status,
        ]);
        return redirect()->route('adminpayment')->with('success', 'Data Payment Berhasil Diupdate');

    }
}
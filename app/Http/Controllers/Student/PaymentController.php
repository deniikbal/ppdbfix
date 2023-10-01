<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Jobs\NotifPayment;
use App\Models\Payment;
use App\Models\Student;
use App\Notifications\CreatePayment;
use App\Notifications\NewPayment;
use App\Notifications\NotificationPayment;
use App\Notifications\RegisterStudent;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PaymentController extends Controller
{
    public function index()
    {
        $student = Student::where('user_id', auth()->id())->first();
        $payments = Payment::where('student_id', $student->id)->get();
        return view('student.payment.main', compact('payments'));
    }

    public function uploadtp(Request $request, Student $student)
    {

        $request->validate([
            'bukti_bayar' => 'required|image|max:1028',
            'tanggal' => 'required',
            'jenis_pembayaran' => 'required',
        ],
            [
                'nominal.required' => 'Wajib diisi nominal pembayaran',
                'bukti_bayar.required' => 'Wajib pilih dahulu',
                'bukti_bayar.image' => 'File Wajib gambar',
            ]);
        $idbayar = IdGenerator::generate(['table' => 'payments', 'field' => 'id_bayar', 'length' => 9, 'prefix' => 'INV-']);
        if ($request->file('bukti_bayar')) {
            $save = $request->file('bukti_bayar')->store('bukti_bayar');
        }
        $payment = Payment::create([
            'student_id' => $request->id,
            'id_bayar' => $idbayar,
            'jenis_pembayaran' => $request->jenis_pembayaran,
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal,
            'jenis_bayar' => $request->jenis_bayar,
            'bukti_bayar' => $save,
        ]);
        NotifPayment::dispatch($payment);
        //Notification::send($payment, new NewPayment($payment));
        return redirect()->back()->with('success', 'Upload Bukti Pembayaran Berhasil');
    }
}

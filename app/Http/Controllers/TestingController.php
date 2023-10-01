<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use App\Models\User;
use App\Notifications\NewPayment;
use App\Notifications\RegisterStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TestingController extends Controller
{
    public function testing()
    {
        return view('testing');
    }

    public function sendnotif(User $user)
    {
        $student = Student::find(3);
        Notification::send($student, new RegisterStudent($student));
        return back();
    }

    public function bayar()
    {
        $payment = Payment::find(36);
        Notification::send($payment, new NewPayment($payment));
        return back();

    }
}

<?php

namespace App\Notifications;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramFile;

class NewPayment extends Notification implements ShouldQueue
{
    use Queueable;

    private $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    public function via(object $notifiable): array
    {
        return ['telegram'];
    }

    public function toTelegram($notifiable)
    {
        $payment = $this->payment;
        $student = Student::where('id', $payment->student_id)->first();
        $linkimage = url('storage/' . $payment->bukti_bayar);
        return TelegramFile::create()
            ->to(-1001947572376)
            ->content("*Pembayaran Administrasi*\n \n*Nama*: $student->name\n*No Daftar*: $student->nodaftar\n*Nominal* : Rp. $payment->nominal\n*Id Bayar* : $payment->id_bayar\n*Jenis Pembayaran* : $payment->jenis_pembayaran \n*Bayar* : $payment->jenis_bayar")
            //->file('/storage/' . $payment->bukti_bayar, 'photo'); // local photo
            //->photo("https://ppdb.smatelkombandung.sch.id/storage/foto/u2QO5NrHZFE2bd15GimUYd4KkzBT1B4L25BMwMOH.jpg");
            ->photo("$linkimage");
    }
}

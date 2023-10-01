<?php

namespace App\Notifications;

use App\Models\Payment;
use App\Models\Student;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramLocation;
use NotificationChannels\Telegram\TelegramMessage;

class CreatePayment extends Notification implements ShouldQueue
{
    use Queueable;

    private $payment;

    /**
     * Create a new notification instance.
     */
    public function __construct($payment)
    {
        $this->payment = $payment;
    }

    public function via($notifiable)
    {
        return ["telegram"];
    }

    public function toTelegram($payment)
    {
        $url = url('/login/');
        $wa = 'https://wa.me/085155333252';

        return TelegramMessage::create()
            ->to('-1001947572376')
            ->content("*Pendaftaran Calon Siswa Berhasil* \n")
            ->line("donal");
    }
}

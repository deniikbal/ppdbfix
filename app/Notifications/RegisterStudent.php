<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class RegisterStudent extends Notification implements ShouldQueue
{
    use Queueable;

    private $student;

    /**
     * Create a new notification instance.
     */
    public function __construct($student)
    {
        $this->student = $student;
    }

    public function via($notifiable)
    {
        return ["telegram"];
    }

    public function toTelegram($student)
    {
        $url = url('/login/');
        $wa = 'https://wa.me/085155333252';

        return TelegramMessage::create()
            ->to('-1001947572376')
            ->content("*Pendaftaran Calon Siswa Berhasil* \n")
            ->line("\n*Nama Lengkap* : $student->name \n*No Daftar* : $student->nodaftar \n*Jenis Kelamin* : $student->jenis_kelamin \n*Kecamatan Domisili* : $student->kec_pd \n*Asal Sekolah* : $student->asal_sekolah \n*No HP* : $student->nohp_siswa");
    }
}

<?php

namespace App\Notifications;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class RegisterStudent extends Notification implements ShouldQueue
{
    use Queueable;

    private $student;


    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function via(object $notifiable): array
    {
        return ['telegram'];
    }

    public function toTelegram($notifiable)
    {
        $student = $this->student;
        return TelegramMessage::create()
            ->to(-1001947572376)
            ->content("*Pendaftaran Calon Siswa Berhasil* \n")
            ->line("\n*Nama Lengkap* : $student->name \n*No Daftar* : $student->nodaftar \n*Jenis Kelamin* : $student->jenis_kelamin \n*Kecamatan Domisili* : $student->kec_pd \n*Asal Sekolah* : $student->asal_sekolah \n*No HP* : $student->nohp_siswa");
    }


}

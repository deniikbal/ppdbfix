<?php

namespace App\Notifications;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
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
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        $student = $this->student;
        $now=now()->format('Y');
        return (new \TelegramNotifications\Messages\TelegramMessage([
            'text' => '<strong>Pendaftaran Calon Siswa Berhasil</strong>

                        <strong>Nama Lengkap : </strong>' . $student->name . '
                        <strong>No Daftar : </strong>' . $student->nodaftar . '
                        <strong>Jenis Kelamin : </strong>' . $student->jenis_kelamin . '
                        <strong>Kecamatan Domisili : </strong>' . $student->kec_pd . '
                        <strong>Asal Sekolah : </strong>' . $student->asal_sekolah . '

                        <strong>PPDB SMA TELKOM '. $now .' </strong>',
            'parse_mode' => 'html'
        ]));
    }
}

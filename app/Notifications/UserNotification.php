<?php

namespace App\Notifications;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use TelegramNotifications\Messages\TelegramMessage;
use TelegramNotifications\TelegramChannel;

class UserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via()
    {
        return [TelegramChannel::class];
    }

    public function toTelegram()
    {
        $user = $this->user;
        //$user = User::find(Auth::id());
        return (new TelegramMessage([
            'text' => '<strong>Pendaftaran Calon Siswa Berhasil</strong> 
<strong>Nama Lengkap : </strong>' . $user->name . '

<strong>Email : </strong>' . $user->email . '
<strong>Password : </strong>' . $user->password_plain . '

<strong>PPDB SMA TEL 2023</strong>',
            'parse_mode' => 'html'
        ]));
    }

}

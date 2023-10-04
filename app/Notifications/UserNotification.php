<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use TelegramNotifications\Messages\TelegramMessage;
use TelegramNotifications\TelegramChannel;

class UserNotification extends Notification
{
    use Queueable;

    public function via()
    {
        return [TelegramChannel::class];
    }

    public function toTelegram()
    {
        return (new TelegramMessage())->text('Hello, world!');
    }

}

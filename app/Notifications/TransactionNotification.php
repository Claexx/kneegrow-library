<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class TransactionNotification extends Notification
{
    use Queueable;

    public $message;
    public $type;

    public function __construct($message, $type = 'info')
    {
        $this->message = $message;
        $this->type = $type; // 'success', 'error', 'warning', 'info'
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'type' => $this->type,
            'timestamp' => now(),
        ];
    }
}

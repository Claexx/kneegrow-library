<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class FineNotification extends Notification
{
    use Queueable;

    public $transaction;
    public $denda;
    public $hari_terlambat;

    public function __construct($transaction, $denda, $hari_terlambat)
    {
        $this->transaction = $transaction;
        $this->denda = $denda;
        $this->hari_terlambat = $hari_terlambat;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Buku '{$this->transaction->book->judul}' terlambat {$this->hari_terlambat} hari. Denda: Rp " . number_format($this->denda, 0, ',', '.'),
            'type' => 'warning',
            'transaction_id' => $this->transaction->id,
            'denda' => $this->denda,
            'hari_terlambat' => $this->hari_terlambat,
        ];
    }
}

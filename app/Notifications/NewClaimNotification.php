<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NewClaimNotification extends Notification
{
    use Queueable;

    protected $claim;

    public function __construct($claim)
    {
        $this->claim = $claim;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Ada klaim baru pada barang Anda: {$this->claim->item->name}",
            'claim_id' => $this->claim->id,
            'claimer_name' => $this->claim->user->name,
            'answer' => $this->claim->message,
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line("Ada klaim baru pada barang Anda: {$this->claim->item->name} dari {$this->claim->user->name}")
            ->action('Lihat Klaim', url('/claims/pending'))
            ->line('Silakan verifikasi klaim tersebut.');
    }
}

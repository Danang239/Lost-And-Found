<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;  // jika ingin antri (queue)
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ClaimRejectedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $claim;

    public function __construct($claim)
    {
        $this->claim = $claim;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];  // simpan di database dan kirim email
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Klaim Anda pada barang '{$this->claim->item->name}' ditolak oleh pemilik.",
            'claim_id' => $this->claim->id,
            'item_name' => $this->claim->item->name,
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Klaim Barang Ditolak')
            ->line("Klaim Anda pada barang '{$this->claim->item->name}' telah ditolak oleh pemilik barang.")
            ->action('Lihat Barang', url("/items/{$this->claim->item->id}"))
            ->line('Silakan coba klaim ulang dengan jawaban yang benar.');
    }
}

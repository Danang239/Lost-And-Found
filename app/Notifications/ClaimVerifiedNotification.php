<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ClaimVerifiedNotification extends Notification
{
    use Queueable;

    protected $claim;
    protected $approved;

    public function __construct($claim, $approved)
    {
        $this->claim = $claim;
        $this->approved = $approved;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toDatabase($notifiable)
    {
        // Ambil nomor WhatsApp dari pemilik barang (user yang mengunggah item)
        $ownerPhone = optional($this->claim->item->user)->phone;

        return [
            'message' => $this->approved
                ? "Klaim Anda pada barang {$this->claim->item->name} disetujui."
                : "Klaim Anda pada barang {$this->claim->item->name} ditolak.",
            'claim_id' => $this->claim->id,
            'approved' => $this->approved,
            'phone' => $ownerPhone, // tambahkan nomor WA ke notifikasi
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line($this->approved
                ? "Selamat! Klaim Anda pada barang {$this->claim->item->name} disetujui."
                : "Maaf, klaim Anda pada barang {$this->claim->item->name} ditolak.")
            ->action('Lihat Klaim Saya', url('/claims'));
    }
}

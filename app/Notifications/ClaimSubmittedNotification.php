<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ClaimSubmittedNotification extends Notification
{
    use Queueable;

    protected $claim;

    public function __construct($claim)
    {
        $this->claim = $claim;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Ada klaim baru pada barang '{$this->claim->item->name}' oleh {$this->claim->user->name}.",
            'claim_id' => $this->claim->id,
            'item_id' => $this->claim->item->id,
        ];
    }
}

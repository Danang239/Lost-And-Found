<?php

namespace App\Mail;

use App\Models\Claim;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClaimStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public Claim $claim;

    /**
     * Create a new message instance.
     */
    public function __construct(Claim $claim)
    {
        $this->claim = $claim;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Status Klaim Barang Anda')
            ->view('emails.claim-status');
    }
}

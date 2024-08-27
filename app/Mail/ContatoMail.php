<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContatoMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $details;
    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        return $this->from('no_reply@freezolar.com.br')
                ->view('mails.contato')
                ->with([
                    'contato' => $this->details,
                ]);
    }
}

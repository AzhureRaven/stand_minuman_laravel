<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PromosiMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $nama, $body, $subject;
    public function __construct($nama, $body, $subject)
    {
        $this->nama = $nama;
        $this->body = $body;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('admin.email')
        ->from("mail@standminuman.com","Admin")
        ->with([
            'nama' => $this->nama,
            'body' => $this->body,
            'subject' => $this->subject
        ]);
    }
}

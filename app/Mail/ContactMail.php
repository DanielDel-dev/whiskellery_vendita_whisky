<?php

namespace App\Mail;

use App\Mail\ContactMail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $bag;
    public function __construct($bag)
    {
        $this->bag = $bag;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('whiskilleria@salute.com')
                    ->view('mail.show');
    }
}

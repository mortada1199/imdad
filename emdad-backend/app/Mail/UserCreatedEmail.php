<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreatedEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->viewData = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()

    {
        // dd($this->viewData['lang'] );
        return $this->from(env('MAIL_USERNAME'), 'Emdad Platform')
                    ->subject('Welcome to Emdad')
                    ->view($this->viewData['lang'] == 'en'?'mail.user-created.en':'mail.user-created.ar',["viewData"=>$this->viewData]);
    }
}

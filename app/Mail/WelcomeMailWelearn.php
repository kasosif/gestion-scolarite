<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMailWelearn extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    protected $plainpass;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $plainpass)
    {
        $this->user = $user;
        $this->plainpass = $plainpass;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('administration@welearn.com')
            ->subject('Bienvenue à WeLearn')
            ->view('mails.welecomewelearn',['user' => $this->user, 'plainpass' => $this->plainpass]);
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DocumentReady extends Notification
{
    use Queueable;
    protected $icone;
    protected $texte;
    public function __construct($icone, $texte)
    {
        $this->icone = $icone;
        $this->texte = $texte;
    }
    public function via()
    {
        return ['database'];
    }
    public function toArray()
    {
        return [
            'icone' => $this->icone,
            'texte' => $this->texte,
        ];
    }
}

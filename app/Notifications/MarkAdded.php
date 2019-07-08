<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MarkAdded extends Notification
{
    use Queueable;
    protected $icone;
    protected $devoir;
    protected $texte;
    public function __construct($icone, $devoir, $texte)
    {
        $this->icone = $icone;
        $this->devoir = $devoir;
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
            'devoir' => $this->devoir->type. ' '. $this->devoir->matiere->nom,
            'texte' => $this->texte,
        ];
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MissedAdded extends Notification
{
    use Queueable;
    protected $icone;
    protected $texte;
    protected $seance;
    public function __construct($icone, $seance, $texte)
    {
        $this->icone = $icone;
        $this->seance = $seance;
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
            'seance' => date('H:i', strtotime($this->seance->heure_debut)). ' => '. date('H:i', strtotime($this->seance->heure_fin)),
            'texte' => $this->texte,
        ];
    }
}

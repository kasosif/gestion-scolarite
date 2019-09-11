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
    protected $lien;
    protected $classe;
    public function __construct($icone, $seance, $texte, $lien , $classe = null)
    {
        $this->icone = $icone;
        $this->seance = $seance;
        $this->texte = $texte;
        $this->lien = $lien;
        $this->classe = $classe;
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
            'lien' => $this->lien,
            'classe' => $this->classe ? $this->classe->abbreviation. " ". $this->classe->niveau->specialite->nom. " ".$this->classe->niveau->nom : '',
        ];
    }
}

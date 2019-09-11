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
    protected $lien;
    public function __construct($icone, $devoir, $texte, $lien)
    {
        $this->icone = $icone;
        $this->devoir = $devoir;
        $this->texte = $texte;
        $this->lien = $lien;
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
            'lien' => $this->lien,
        ];
    }
}

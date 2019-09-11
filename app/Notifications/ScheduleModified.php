<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ScheduleModified extends Notification
{
    use Queueable;

    protected $icone;
    protected $date;
    protected $texte;
    protected $lien;
    public function __construct($icone, $date, $texte, $lien)
    {
        $this->icone = $icone;
        $this->date = $date;
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
            'date' => $this->date,
            'texte' => $this->texte,
            'lien' => $this->lien,
        ];
    }
}

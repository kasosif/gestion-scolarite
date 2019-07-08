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
    public function __construct($icone, $date, $texte)
    {
        $this->icone = $icone;
        $this->date = $date;
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
            'date' => $this->date,
            'texte' => $this->texte,
        ];
    }
}

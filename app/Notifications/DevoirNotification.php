<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DevoirNotification extends Notification
{
    use Queueable;
    protected $icone;
    protected $texte;
    protected $devoir;
    protected $lien;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($icone, $texte, $devoir, $lien)
    {
        $this->icone = $icone;
        $this->devoir = $devoir;
        $this->texte = $texte;
        $this->lien = $lien;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'icone' => $this->icone,
            'devoir' => $this->devoir->type. " ".$this->devoir->matiere->nom,
            'texte' => $this->texte,
            'lien' => $this->lien,
        ];
    }
}

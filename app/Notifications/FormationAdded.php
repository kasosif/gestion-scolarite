<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FormationAdded extends Notification
{
    use Queueable;
    protected $icone;
    protected $formation;
    protected $texte;
    protected $lien;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($icone, $formation, $texte, $lien)
    {
        $this->icone = $icone;
        $this->formation = $formation;
        $this->texte = $texte;
        $this->lien = $lien;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via()
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'devoir' => $this->formation->titre,
            'texte' => $this->texte,
            'lien' => $this->lien,
        ];
    }
}

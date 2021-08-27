<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Application extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data=$data;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
        ->line('Dear'. $this->data['name'] )
        ->line('This is to let you know that we have received your application.')
        ->line('We appreciate your interest in Machinestalk Tunisia and the position of '. $this->data['job'] . ' for which you applied.')
        ->line('If you are selected for an interview, you can expect a phone call from our Human Resources staff shortly.')
        ->line(' Thank you, again, for your interest in our company. We do appreciate the time that you invested in this application.')
        ->line('Sincerely')
        ->line('Human capital team');
       
        

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
            //
        ];
    }
}

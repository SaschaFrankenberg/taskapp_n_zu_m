<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PushToTask extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected Task $task)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {   //
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Hallo')
            ->line('Du hast neue Aufgaben.')
            ->line('Aufgabe: ' . $this->task->title)
            ->action('Zur Aufgabe ', url('/tasks/' . $this->task->id))
            ->line('Viel Spaß bei der Aufgabe!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            // Felder des Arrays definieren (beliebig erweiterbar)
            'title' => $this->task->title,
            'url' => url('/tasks/' . $this->task->id),
            'message' => 'Neue Aufgabe',
        ];
    }
}

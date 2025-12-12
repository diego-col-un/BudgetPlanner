<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OverSpendNotification extends Notification
{
    use Queueable;

    protected $alert;

    public function __construct($alert)
    {
        $this->alert = $alert;
    }

    public function via($notifiable)
    {
        //mail se envia por mailtrap
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->alert->title)
            ->line($this->alert->message)
            ->action('Ver transacciones', url('/transactions'))
            ->line('Revisa tus transacciones o ajusta tu presupuesto.');
    }

    public function toArray($notifiable)
    {
        return [
            'alert_id' => $this->alert->id,
            'title' => $this->alert->title,
            'message' => $this->alert->message,
        ];
    }
}

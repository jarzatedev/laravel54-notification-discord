<?php

namespace App\Notifications;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DiscordNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return [];
    }

    public function toDiscord($notifiable)
    {
        $message = "¡Hola! Esta es una notificación de Laravel a Discord.";
        $webhookUrl = env('DISCORD_WEBHOOK_URL');

        $data = [
            'content' => $message
        ];

        $payload = json_encode($data);

        $headers = [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($payload)
        ];

        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);
    }

    public function send($notifiable)
    {
        $this->toDiscord($notifiable);
    }
}

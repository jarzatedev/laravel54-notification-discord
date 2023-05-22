<?php

namespace App\Services;

use GuzzleHttp\Client;

class DiscordNotificationService
{
    public function sendNotification($message)
    {
        $webhookUrl = env('DISCORD_WEBHOOK_URL');

        $client = new Client();
        $response = $client->post($webhookUrl, [
            'json' => ['content' => $message]
        ]);

        if ($response->getStatusCode() === 204) {
            return true;
        } else {
            return false;
        }
    }
}
<?php

namespace App\Http\Controllers\Api;

use App\Services\DiscordNotificationService;
use App\Http\Controllers\Controller;

class NotificationDiscordController extends Controller
{
    public function sendNotification()
    {
        $discordService = new DiscordNotificationService();
        $message = "¡Hola! Esta es una notificación de Laravel a Discord.";
        $result = $discordService->sendNotification($message);
        $responseMessage = $result ? "Notificación enviada correctamente." : "Notificación no enviada.";
        $data = [
            'message' => $responseMessage,
            'data' => $result,
        ];
        return response()->json($data, 200);
    }
}

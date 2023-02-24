<?php

namespace App\Traits;

use App\Models\BotHistory;
use Melipayamak;
use Telegram;

trait AdminTelegram
{
    public function adminNotificarion($text){
        $telegram = new Telegram(env('TELEGRAM_BOT_TOKEN'));

        $users = BotHistory::where([['permission','admin']])->get();
        foreach ($users as $user){
            $content = array("chat_id" => $user->chat_id, 'text' => $text);
            $telegram->sendMessage($content);
        }
    }
}

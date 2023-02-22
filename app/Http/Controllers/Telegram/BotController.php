<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Telegram;

class BotController extends Controller
{
    public function index(){
        $telegram = new Telegram(env('TELEGRAM_BOT_TOKEN'));
        $text = $telegram->Text();
        $chat_id = $telegram->ChatID();

        if (!is_null($text) && !is_null($chat_id)) {
            if ($text=='/start'){
                $fName = $telegram->FirstName();
                $text = "سلام " . $fName . " عزیز\n" . "به ربات پشتیبانی سئومپ خوش آمدید";
                $content = array("chat_id" => $this->chat_id, 'text' => $text);
                $telegram->sendMessage($content);
            }elseif ($text=='/admin @#!12asG%%$@'){
                
            }
        }
    }
}

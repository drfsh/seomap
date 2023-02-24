<?php

namespace App\Http\Controllers\Telegram;

use App\Http\Controllers\Controller;
use App\Models\BotHistory;
use App\Models\User;
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
                $content = array("chat_id" => $chat_id, 'text' => $text);
                $telegram->sendMessage($content);
            }else{
                $keywords = preg_split("/[\s,]+/", $text);
                if ($keywords[0]=='/admin'){
                    if ($keywords[1]=='$p14#s@6'){
                        $user = User::where('mobile',$keywords[2])->first();
                        if (!$user){
                            $text = "شماره تلفن اشتباه میباشد.";
                        }else{
                            $history = BotHistory::where('chat_id',$chat_id)->first();
                            if (!$history){
                                BotHistory::create([
                                    'user_id'=>$user->id,
                                    'chat_id'=>$chat_id,
                                    'permission'=>'admin'
                                ]);
                            }else{
                                $history->chat_id = $chat_id;
                                $history->user_id = $user->id;
                                $history->permission = 'admin';
                                $history->save();
                            }
                            $text = "$user->name  با موفقیت به سیستم مدیریت متصل شدید. ";
                        }
                        $content = array("chat_id" => $chat_id, 'text' => $text);
                        $telegram->sendMessage($content);
                    }
                }else{

                    $text = "پیام نامشخص :(";
                    $content = array("chat_id" => $chat_id, 'text' => $text);
                    $telegram->sendMessage($content);
                }
            }
        }
    }
}

<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\seen;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NotificationController extends Controller
{
    public function list(){
        $this->seen();
        return Inertia::render('Panel/Notifications',[
            'notifications'=>Notification::where('for_user_id',null)->orWhere('for_user_id',auth()->id())->orderBy('created_at','desc')->paginate(10)
        ]);
    }
    public function view($id){
        $not = Notification::where([['for_user_id',null],['id',$id]])->orWhere([['for_user_id',auth()->id()],['id',$id]])->first();
        if (!$not) abort(404);
        return Inertia::render('Panel/Notification',[
            'notification'=>$not
        ]);
    }

    private function seen(){
        $notification = Notification::all();
        foreach ($notification as $v){

            $see = seen::where([['user_id',auth()->id()],['for','notif'],['for_id',$v->id]])->first();
            if (!$see){
                seen::create([
                    'user_id'=>auth()->id(),
                    'for'=>'notif',
                    'for_id'=>$v->id
                ]);
            }
        }
    }
}

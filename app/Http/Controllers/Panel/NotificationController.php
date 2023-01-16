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
            'notifications'=>Notification::orderBy('created_at','desc')->paginate(10)
        ]);
    }
    public function view($id){
        $not = Notification::find($id);
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

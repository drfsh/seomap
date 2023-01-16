<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Mockery\Matcher\Not;

class NotificationController extends Controller
{
    public function view(){
        return Inertia::render('Admin/Notifications',[
            'notifications'=>Notification::orderBy('created_at','desc')->paginate(10)
        ]);
    }

    public function create(){
        return Inertia::render('Admin/NotificationCreate');
    }

    public function store(Request $request){
        $title = $request->title;
        $icon = $request->icon;
        $body = $request->body;
        $user_id = auth()->id();

        $not = new Notification();
        $not->title = $title;
        $not->icon = $icon;
        $not->body = $body;
        $not->user_id = $user_id;
        $not->save();

        return redirect()->intended(route('admin.notifications'));
    }

    public function notification($id){
        $not = Notification::find($id);
        if (!$not) abort(404);
        return Inertia::render('Admin/Notification',[
            'notification'=>$not
        ]);
    }

    public function edit($id){
        $not = Notification::find($id);
        if (!$not) abort(404);
        return Inertia::render('Admin/NotificationEdit',[
            'notification'=>$not
        ]);
    }

    public function update($id,Request $request){
        $title = $request->title;
        $icon = $request->icon;
        $body = $request->body;

        $not = Notification::find($id);
        $not->title = $title;
        $not->icon = $icon;
        $not->body = $body;
        $not->save();

        return redirect()->intended(route('admin.notification',['id'=>$id]));
    }
}

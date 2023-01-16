<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Notification;
use App\Models\Project;
use App\Models\seen;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function view(): \Inertia\Response
    {
        return Inertia::render('Panel/Dashboard', [
            'projects' => auth()->user()->projects,
        ]);
    }

    public function countAlert(){
        $notification = Notification::all();
        $c = 0;
        foreach ($notification as $v){
            $see = seen::where([['user_id',auth()->id()],['for','notif'],['for_id',$v->id]])->first();
            if (!$see)
                $c++;
        }
        $tickets = Ticket::where([['user_id',auth()->id()],['new',1]])->count();
        return $this->sendTrue(['notification'=>$c,'ticket'=>$tickets],[]);
    }

}

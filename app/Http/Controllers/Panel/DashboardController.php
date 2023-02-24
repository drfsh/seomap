<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Project;
use App\Models\seen;
use App\Models\Ticket;
use App\Traits\Smstrait;
use Carbon\Carbon;
use Inertia\Inertia;
use Melipayamak;
use Melipayamak\MelipayamakApi;

class DashboardController extends Controller
{
    public function view()
    {
        $id = auth()->id();
        $project = Project::with('service')->where('user_id',$id)->get();
        $c = false;
        foreach ($project as $value){
            $i = $value->invoices;
            foreach ($i as $item)
                if ($item->status==0){
                    $c = $value;
                    break;
                }
        }
        return Inertia::render('Panel/Dashboard', [
            'projects' => auth()->user()->projects,
            'pay' => $c,
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

    public function infoSlider(){
        $id = auth()->id();
        $project = Project::where('user_id',$id)->get();
        $c = false;
        foreach ($project as $value){
            $i = $value->invoices;
            foreach ($i as $item)
                if ($item->status==0){
                    $c = true;
                    break;
                }
        }
        return $this->sendTrue(['projects'=>$c],[]);

    }

    use Smstrait;
    public function test(){
        $text = '/start';
        $keywords = preg_split("/[\s,]+/", $text);
        dd($keywords);
    }
}

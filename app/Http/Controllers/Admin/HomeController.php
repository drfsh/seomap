<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Tightenco\Ziggy\Ziggy;

class HomeController extends Controller
{
    public function view(){
        return Inertia::render('Admin/Dashboard', [
            'projects' => Project::with('service')->latest()->take(2)->get(),
        ]);
    }


    public function infoSlider(){
        $project = Project::where('status',0)->count();
        $tickets = Ticket::where('status',0)->count();

        return $this->sendTrue(['projects'=>$project,'tickets'=>$tickets],[]);

    }

}

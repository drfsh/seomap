<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Tightenco\Ziggy\Ziggy;

class HomeController extends Controller
{
    public function view(){
        return Inertia::render('Admin/Dashboard', [
            'projects' => Project::latest()->take(2)->get(),
        ]);
    }
}

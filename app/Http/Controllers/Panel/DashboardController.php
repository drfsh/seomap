<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Project;
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
}

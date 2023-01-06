<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function view(): \Inertia\Response
    {
        return Inertia::render('Panel/Dashboard', [
            'data1' => 123,
        ]);
    }
}

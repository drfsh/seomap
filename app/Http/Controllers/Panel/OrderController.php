<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function service(){
        return Inertia::render('Panel/Service');
    }

    public function view(){
        return Inertia::render('Panel/Orders');
    }
}

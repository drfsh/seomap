<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HomeController extends Controller
{
    public function view(){
        return Inertia::render('Home/Home');
    }
}

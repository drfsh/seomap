<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function view(){
        return Inertia::render('Admin/Services', [
            'services' => Service::orderBy('sort','desc')->get(),
        ]);
    }

    public function create(){
        return Inertia::render('Admin/ServiceCreate');
    }

    public function store(Request $request){

        $name = $request->name;
        $des = $request->description;
        $slug = $request->slug;

        $service = new Service();
        if (!$service) abort(404);

        $service->name = $name;
        $service->description = $des;
        $service->slug = $slug;

        if ($request->hasFile('image')){
            $path = $this->upload($request->file('image'));
            $service->image = $path;
        }else{
            $service->image = '/images/icons/add-square.svg';
        }

        $service->save();

        return redirect()->intended(route('admin.services'));
    }

    public function edit($id){
        $service = Service::find($id);
        if (!$service) abort(404);
        return Inertia::render('Admin/ServiceEdit',[
            'service'=> $service
        ]);
    }

    public function update(Request $request){
        $id = $request->id;
        $name = $request->name;
        $des = $request->description;
        $slug = $request->slug;

        $service = Service::find($id);
        if (!$service) abort(404);

        $service->name = $name;
        $service->description = $des;
        $service->slug = $slug;

        if ($request->hasFile('image')){
            $path = $this->upload($request->file('image'));
            $service->image = $path;
        }
        $service->save();
        return redirect()->intended(route('admin.services'));
    }
}

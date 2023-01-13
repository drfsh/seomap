<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use App\Models\Type;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function service()
    {
        return Inertia::render('Panel/Service', [
            'services' => Service::where('enable', true)->get()
        ]);
    }

    public function view()
    {
        return Inertia::render('Panel/Orders');
    }

    public function create($slug)
    {
        $service = Service::where('slug', $slug)->first();
        if (!$service) abort(404);

        switch ($service->form) {
            case 0:
                return Inertia::render('Panel/ServicesForm/FormWebNew', [
                    'service' => $service,
                    'type' => $service->sTypes(),
                    'platform' => $service->sPlatforms(),
                ]);
            default:
                abort(404);
        }
    }

    public function store(Request $request)
    {
        $service = Service::find($request->service);
//        $project = new Project();
        switch ($service->form) {
            case 0:
                return $this->newWeb($request);
            default:
                abort(404);
        }
    }

    private function newWeb($request){
        dd($request->file('file'));
    }
}

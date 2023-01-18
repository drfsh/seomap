<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Project;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function store(Request $request){
        $pId = $request->project;
        $project = Project::find($pId);
        if (!$project) abort(404);
        $amount = $request->amount;
        $info = $request->info;
        Invoice::create([
            'info'=>$info,
            'amount'=>$amount,
            'project_id'=>$pId,
            'data'=>1
        ]);

        return redirect(route('admin.order',['code'=>$project->code]));
    }
}

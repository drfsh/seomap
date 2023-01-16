<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrdersController extends Controller
{
    public function view(Request $request){
        $code = (int)$request->code;
        if (!$code)
        return Inertia::render('Admin/Orders',[
            'projects'=>Project::orderBy('created_at','desc')->orderBy('status','desc')->paginate(10),
            'pComing'=>Project::where('status',2)->orderBy('created_at','desc')->paginate(10),
            'pPey'=>Project::where('status',3)->orWhere('status',1)->orderBy('created_at','desc')->paginate(10),
            'pOk'=>Project::where('status',4)->orderBy('created_at','desc')->paginate(10),
            'pCancel'=>Project::where('status',5)->orderBy('created_at','desc')->paginate(10),
        ]);
        else{
            //searching by code
            return Inertia::render('Admin/Orders',[
                'projects'=>Project::where('id',$code-3500)->orderBy('created_at','desc')->orderBy('status','desc')->paginate(10),
                'pComing'=>Project::where([['status',2],['id',$code-3500]])->orderBy('created_at','desc')->paginate(10),
                'pPey'=>Project::where([['status',3],['id',$code-3500]])->orWhere([['status',1],['id',$code-3500]])->orderBy('created_at','desc')->paginate(10),
                'pOk'=>Project::where([['status',4],['id',$code-3500]])->orderBy('created_at','desc')->paginate(10),
                'pCancel'=>Project::where([['status',5],['id',$code-3500]])->orderBy('created_at','desc')->paginate(10),
                'code'=>$code
            ]);
        }
    }

    public function project($code){
        $code = (int) $code;
        $project = Project::with(['user','attr_new','attrs','ticket','invoices','plan','service'])->find($code-3500);
//        return $this->sendTrue($project,[]);
        if (!$project) abort(404);
        return Inertia::render('Admin/Order',[
            'project'=>$project,
        ]);
    }
}

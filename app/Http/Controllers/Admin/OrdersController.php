<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
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
            'projects'=>Project::orderBy('created_at','desc')->orderBy('status','desc')->with('service')->paginate(10),
            'pComing'=>Project::where('status',2)->orderBy('created_at','desc')->with('service')->paginate(10),
            'pPey'=>Project::where('status',3)->orWhere('status',1)->orderBy('created_at','desc')->with('service')->paginate(10),
            'pOk'=>Project::where('status',4)->orderBy('created_at','desc')->with('service')->paginate(10),
            'pCancel'=>Project::where('status',5)->orderBy('created_at','desc')->with('service')->paginate(10),
        ]);
        else{
            //searching by code
            return Inertia::render('Admin/Orders',[
                'projects'=>Project::where('id',$code-3500)->orderBy('created_at','desc')->with('service')->orderBy('status','desc')->paginate(10),
                'pComing'=>Project::where([['status',2],['id',$code-3500]])->with('service')->orderBy('created_at','desc')->paginate(10),
                'pPey'=>Project::where([['status',3],['id',$code-3500]])->orWhere([['status',1],['id',$code-3500]])->with('service')->orderBy('created_at','desc')->paginate(10),
                'pOk'=>Project::where([['status',4],['id',$code-3500]])->orderBy('created_at','desc')->with('service')->paginate(10),
                'pCancel'=>Project::where([['status',5],['id',$code-3500]])->orderBy('created_at','desc')->with('service')->paginate(10),
                'code'=>$code
            ]);
        }
    }

    public function project($code){
        $code = (int) $code;
        $project = Project::with(['user','attr_new','ticket','invoices','plan','service','access'])->find($code-3500);
//        return $this->sendTrue($project,[]);
        if (!$project) abort(404);
        $attrsOne = $project->attrs;
        $attrs = [];
         $i = $project->invoices;
        $dontPay = 0;
        foreach ($i as $v)
        {
            if ($v->status!=1)
                $dontPay++;
        }
        foreach ($attrsOne as $attr){
                $attrs[$attr->type][] = $attr;
        }
        return Inertia::render('Admin/Order',[
            'project'=>$project,
            'attrs'=>$attrs,
            'dont_pay'=>$dontPay
        ]);
    }

    public function attrUpdate($id,Request $request){
        $type = $request->type;
        $name = $request->name;
        $value = $request->value;
        $des = $request->des;
        $attr = Attribute::where([['project_id',$id],['type',$type]])->first();
        if ($attr){
            $attr->update([
                'name'=>$name,
                'value'=>$value,
                'description'=>$des
            ]);
        }
        return $this->sendTrue([],[]);
    }
    public function attrStore(Request $request){
//        dd('ddd');
        $type = $request->type;
        $name = $request->name;
        $value = $request->value;
        $des = $request->description;
        $pro = $request->project_id;
        $a = Attribute::create([
            'name'=>$name,
            'value'=>$value,
            'description'=>$des,
            'type'=>$type,
            'project_id'=>$pro,
        ]);
        return $this->sendTrue($pro,[]);
    }
    public function attrDelete($id){
        $attr = Attribute::find($id);
        $attr->delete();
        return $this->sendTrue([],[]);
    }

    public function status(Request $request){
        $id = $request->id;
        $status = $request->status;
        $p = Project::find($id);
        $p->status = $status;
        $p->save();
        return $this->sendTrue($p,[]);
    }

    public function update(Request $request){
        $title = $request->title;
        $fee = $request->fee;
        $days = $request->days;
        $id = $request->id;
        $p = Project::find($id);
        $p->days = $days;
        $p->title = $title;
        $p->fee = $fee;
        $p->save();

        return redirect(route('admin.order',['code'=>$p->code]));
    }
}

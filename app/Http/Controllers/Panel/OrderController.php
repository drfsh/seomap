<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Access;
use App\Models\Attribute;
use App\Models\Invoice;
use App\Models\Plan;
use App\Models\Project;
use App\Models\ProjectNewAttr;
use App\Models\Service;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function service()
    {
        return Inertia::render('Panel/Service', [
            'services' => Service::where('enable', true)->get()
        ]);
    }

    public function list(Request $request)
    {
        $code = (int) $request->code;
        $id = auth()->id();

        if (!$code)
            return Inertia::render('Panel/Orders',[
                'projects'=>Project::where('user_id',$id)->orderBy('created_at','desc')->orderBy('status','desc')->with('service')->paginate(10),
                'pOk'=>Project::where([['status',4],['user_id',$id]])->orderBy('created_at','desc')->with('service')->paginate(10),
                'pCancel'=>Project::where([['status',5],['user_id',$id]])->orderBy('created_at','desc')->with('service')->paginate(10),
            ]);
        else{
            //searching by code
            return Inertia::render('Panel/Orders',[
                'projects'=>Project::where([['id',$code-3500],['user_id',$id]])->orderBy('created_at','desc')->orderBy('status','desc')->with('service')->paginate(10),
                'pOk'=>Project::where([['status',4],['id',$code-3500],['user_id',$id]])->orderBy('created_at','desc')->with('service')->paginate(10),
                'pCancel'=>Project::where([['status',5],['id',$code-3500],['user_id',$id]])->orderBy('created_at','desc')->with('service')->paginate(10),
                'code'=>$code
            ]);
        }
    }

    public function create($slug,Request $request)
    {
        $service = Service::where('slug', $slug)->first();
        if (!$service) abort(404);

        switch ($service->form) {
            case 0:
            {
                $plans = $service->plans;
                $p =[];
                foreach ($plans as $plan)
                    $p[$plan->id] = $plan->name;
                return Inertia::render('Panel/ServicesForm/FormWebNew', [
                    'service' => $service,
                    'type' => $service->sTypes(),
                    'platform' => $service->sPlatforms(),
                    'plan_id'=> $request->plan,
                    'plan'=> $p,
                ]);
            }
            case 2:{
                $services = Service::where('form',2)->get();
                $p =[];
                foreach ($services as $plan)
                    $p[$plan->id] = $plan->name;
                return Inertia::render('Panel/ServicesForm/FormDev', [
                    'service' => $service,
                    'plan_id'=> 1,
                    'services'=> $p,
                ]);
            }
            case 3:{
                $plans = $service->plans;
                $p =[];
                foreach ($plans as $plan)
                    $p[$plan->id] = ' پشتیبانی '.$plan->name;
                return Inertia::render('Panel/ServicesForm/FormSupport', [
                    'service' => $service,
                    'plans'=> $p,
                    'plansa'=> $plans,
                ]);
            }
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
            case 2:
                return $this->newDev($request);
            case 3:
                return $this->newSupport($request);
            default:
                abort(404);
        }
    }

    private function newWeb($request){

        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'mobile' => 'required|regex:/(9)[0-9]/|size:10',
            'platform' => 'required',
            'service' => 'required',
            'plan' => 'required',
            'attrs' => 'required',
            'description' => 'required|min:10|max:4000',
        ]);


        $project = new Project();
        $project->user_id = auth()->id();
        $project->service_id = $request->service;
        $project->plan_id = $request->plan;
        $project->description = $request->description;
        $project->fee = 2000000;
        if ($request->hasFile('file')){
            $path = $this->upload($request->file('file'));
            $project->file = $path;
        }
        $project->save();

        $attrNew = new ProjectNewAttr();
        $attrNew->project_id = $project->id;
        $attrNew->name = $request->name;
        $attrNew->mobile = $request->mobile;
        $attrNew->example = $request->example;
        $attrNew->type_id = $request->type;
        $attrNew->platform_id = $request->platform;
        $attrNew->save();

        foreach($request->attrs as $attr){
            Attribute::create([
                'project_id'=>$project->id,
                'description'=>$attr,
                'name'=>'-',
                'value'=>'-',
                'type'=>'attr',
            ]);
        }
        Attribute::create([
            'project_id'=>$project->id,
            'description'=>$request->lang,
            'name'=>'زبان ها',
            'value'=>'-',
            'type'=>'lang',
        ]);
        $invoice = Invoice::create([
            'info'=>'پیش پرداخت اولیه',
            'amount'=>1000000,//1,000,000 toman
            'project_id'=>$project->id,
            'data'=>0
        ]);
        session(['invoice_id'=>$invoice->id]);
        return redirect(route('order',['code'=>$project->code]));
    }
    private function newDev($request){

        $request->validate([
            'service' => 'required',
            'plan' => 'required',
            'title' => 'required',
            'description' => 'required|min:10|max:4000',
        ]);

        $project = new Project();
        $project->user_id = auth()->id();
        $project->service_id = $request->service;
        $project->plan_id = $request->plan;
        $project->description = $request->description;
        $project->fee = 0;
        $project->title = $request->title;
        if ($request->hasFile('file')){
            $path = $this->upload($request->file('file'));
            $project->file = $path;
        }
        $project->save();

        return redirect(route('order',['code'=>$project->code]));
    }
    private function newSupport($request){

        $request->validate([
            'service' => 'required',
            'plan' => 'required',
            'title' => 'required',
            'host_user' => 'required',
            'host_pass' => 'required',
            'description' => 'required|min:10|max:4000',
        ]);

        $plan = Plan::find($request->plan);

        $project = new Project();
        $project->user_id = auth()->id();
        $project->service_id = $request->service;
        $project->plan_id = $request->plan;
        $project->description = $request->description;
        $project->fee = $plan->fee;
        $project->title = $request->title;
        if ($request->hasFile('file')){
            $path = $this->upload($request->file('file'));
            $project->file = $path;
        }
        $project->save();

        $access = new Access();
        $access->url = $request->title;
        $access->project_id = $project->id;
        $access->web_username = $request->web_user;
        $access->web_password = $request->web_pass;
        $access->host_username = $request->host_user;
        $access->host_password = $request->host_pass;
        $access->save();

        return redirect(route('order',['code'=>$project->code]));
    }


    public function project($code){
        $code = (int) $code;
        $project = Project::where([['id',$code-3500],['user_id',auth()->id()]])->with(['user','attr_new','ticket','invoices','plan','service','access'])->first();
//        return $this->sendTrue($project,[]);
        if (!$project) abort(404);
        $attrsOne = $project->attrs;
        $attrs = [];
        $i = $project->invoices;
        $dontPay = 0;
        $pay = 0;
        foreach ($i as $v)
        {
            if ($v->status!=1)
            {
                $pay = $v->id;
                $dontPay++;
            }
        }
        foreach ($attrsOne as $attr){
            $attrs[$attr->type][] = $attr;
        }

        $status=session('status');
        if ($status)
            session(['status'=>null]);

        $invoice_id=session('invoice_id');
        if ($invoice_id)
            session(['invoice_id'=>null]);

        return Inertia::render('Panel/Order',[
            'project'=>$project,
            'attrs'=>$attrs,
            'dont_pay'=>$dontPay,
            'pay'=>$pay,
            'session' => $status,
            'invoice_id'=>$invoice_id
        ]);
    }

    public function uploadAttrs(Request $request){

        $id = $request->attr_id;
        $info = $request->info;

        $attr = Attribute::find($id);
        if (!$attr || $attr->project->user_id!=auth()->id())
            return abort(404);


        if ($request->hasFile('file')){
            $path = $this->upload($request->file('file'));
            $attr->value = $path;
        }
        $attr->description = $info;
        $attr->value2 = null;
        $attr->save();

        return redirect(route('order',['code'=>$attr->project->code]));
    }

    public function demoChecked(Request $request){

        $id = $request->attr_id;
        $info = $request->info;

        $attr = Attribute::find($id);
        if (!$attr || $attr->project->user_id!=auth()->id())
            return abort(404);

        $attr->name = $info;
        $attr->save();

        return redirect(route('order',['code'=>$attr->project->code]));
    }

}

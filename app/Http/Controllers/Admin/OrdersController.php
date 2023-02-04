<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Access;
use App\Models\Attribute;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Project;
use App\Models\User;
use App\Traits\Smstrait;
use Hekmatinasser\Jalali\Traits\Validation;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Morilog\Jalali\Jalalian;

class OrdersController extends Controller
{
    use Smstrait;

    public function view(Request $request)
    {
        $code = (int)$request->code;
        if (!$code)
            return Inertia::render('Admin/Orders', [
                'projects' => Project::orderBy('created_at', 'desc')->orderBy('status', 'desc')->with('service')->paginate(10),
                'pComing' => Project::where('status', 2)->orderBy('created_at', 'desc')->with('service')->paginate(10),
                'pPey' => Project::where('status', 3)->orWhere('status', 1)->orderBy('created_at', 'desc')->with('service')->paginate(10),
                'pOk' => Project::where('status', 4)->orderBy('created_at', 'desc')->with('service')->paginate(10),
                'pCancel' => Project::where('status', 5)->orderBy('created_at', 'desc')->with('service')->paginate(10),
            ]);
        else {
            //searching by code
            return Inertia::render('Admin/Orders', [
                'projects' => Project::where('id', $code - 3500)->orderBy('created_at', 'desc')->with('service')->orderBy('status', 'desc')->paginate(10),
                'pComing' => Project::where([['status', 2], ['id', $code - 3500]])->with('service')->orderBy('created_at', 'desc')->paginate(10),
                'pPey' => Project::where([['status', 3], ['id', $code - 3500]])->orWhere([['status', 1], ['id', $code - 3500]])->with('service')->orderBy('created_at', 'desc')->paginate(10),
                'pOk' => Project::where([['status', 4], ['id', $code - 3500]])->orderBy('created_at', 'desc')->with('service')->paginate(10),
                'pCancel' => Project::where([['status', 5], ['id', $code - 3500]])->orderBy('created_at', 'desc')->with('service')->paginate(10),
                'code' => $code
            ]);
        }
    }

    public function project($code)
    {
        $code = (int)$code;
        $project = Project::with(['user', 'attr_new', 'ticket', 'invoices', 'plan', 'service', 'access'])->find($code - 3500);
//        return $this->sendTrue($project,[]);
        if (!$project) abort(404);
        $attrsOne = $project->attrs;
        $attrs = [];
        $i = $project->invoices;
        $dontPay = 0;
        foreach ($i as $v) {
            if ($v->status != 1)
                $dontPay++;
        }
        foreach ($attrsOne as $attr) {
            $attrs[$attr->type][] = $attr;
        }


        return Inertia::render('Admin/Order', [
            'project' => $project,
            'attrs' => $attrs,
            'dont_pay' => $dontPay
        ]);
    }

    public function attrUpdate($id, Request $request)
    {
        $type = $request->type;
        $name = $request->name;
        $value = $request->value;
        $des = $request->des;
        $attr = Attribute::where([['project_id', $id], ['type', $type]])->first();
        if ($attr) {
            $attr->update([
                'name' => $name,
                'value' => $value,
                'description' => $des
            ]);
        }
        return $this->sendTrue([], []);
    }

    public function attrStore(Request $request)
    {
//        dd('ddd');
        $type = $request->type;
        $name = $request->name;
        $value = $request->value;
        $des = $request->description;
        $pro = $request->project_id;
        $a = Attribute::create([
            'name' => $name,
            'value' => $value,
            'description' => $des,
            'type' => $type,
            'project_id' => $pro,
        ]);
        return $this->sendTrue($pro, []);
    }

    public function attrDelete($id)
    {
        $attr = Attribute::find($id);
        $attr->delete();
        return $this->sendTrue([], []);
    }

    public function status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        $p = Project::find($id);
//        $user = $p->user;
//        if ($user){
//            if ($p->status==0){
//                if ($status==2)
//                {
//                    $this->Sendsms("$user->name;$p->code;",$user->mobile,119091);
//                }
//                elseif ($status==1)
//                {
//                    $this->Sendsms("$user->name;$p->code;",$user->mobile,119089);
//                }
//            }elseif ($p->status==2){
//                if ($status==1)
//                {
//                    $invoices = $p->invoices;
//                    if (sizeof($invoices)>0){
//                        $invoice = $invoices[sizeof($invoices)-1];
//                        $amount = number_format($invoice->amount);
//                        $this->Sendsms("$user->name;$p->code;$amount",$user->mobile,119095);
//                    }
//                }
//                elseif ($status==3){
//                    $this->Sendsms("$user->name;$p->code",$user->mobile,119093);
//                }
//            }elseif ($status==4){
//                $date = Jalalian::now()->format('Y/m/d');
//                $this->Sendsms("$user->name;$p->code;$date",$user->mobile,119092);
//            }
//        }

        if ($status == 2) {
            $haInfo = false;
            foreach ($p->attrs as $attr) {
                if ($attr->type == 'startDate') {
                    $haInfo = $attr;
                    break;
                }
            }
            if (!$haInfo) {
                Attribute::create([
                    'name' => 'start',
                    'value' => 'start',//process
                    'description' => 'start',
                    'type' => 'startDate',
                    'project_id' => $p->id,
                ]);
            }
        }


        $p->status = $status;
        $p->save();
        return $this->sendTrue($p, []);
    }

    public function update(Request $request)
    {
        $title = $request->title;
        $fee = $request->fee;
        $days = $request->days;
        $id = $request->id;
        $p = Project::find($id);
        $p->days = $days;
        $p->title = $title;
        $p->fee = $fee;
        $p->save();

        return redirect(route('admin.order', ['code' => $p->code]));
    }

    public function createStartAttrs(Request $request)
    {
        $request->validate([
            'info' => ['required'],
        ]);
        $p = Project::find($request->project_id);
        $haInfo = false;
        foreach ($p->attrs as $attr) {
            if ($attr->type == 'startInfo') {
                $haInfo = $attr;
                break;
            }
        }
        if (!$haInfo) {
            Attribute::create([
                'name' => 'info',
                'project_id' => $request->project_id,
                'description' => $request->info,
                'value' => false,
                'type' => 'startInfo'
            ]);
        } else {
            $haInfo->description = $request->info;
            $haInfo->save();
        }

        $attrs = $request->attrs;
        foreach ($attrs as $attr) {
            Attribute::create([
                'name' => $attr['text'],
                'project_id' => $request->project_id,
                'description' => null,
                'value' => null,
                'type' => 'startAttrs'
            ]);
        }
        return redirect(route('admin.order', ['code' => $p->code]));
    }


    public function changeStatusFile(Request $request)
    {
        $id = $request->attr_id;
        $value = $request->value2;
        $attr = Attribute::find($id);

        if ($value == 0)
            $attr->value2 = $request->info?$request->info:'رد شده!فایل صحیح را ارسال کنید.';
        else
            $attr->value2 = $value;
        $attr->save();
        $p = $attr->project;
        return redirect(route('admin.order', ['code' => $p->code]));
    }

    public function setup(Request $request){
        $request->validate([
           'description'=>'required',
           'days'=>'required',
           'price'=>'required',
           'id'=>'required',
        ]);

        $project = Project::find($request->id);
        if (!$project) abort(404);

        $project->fee = $request->price;
        $project->days = $request->days;
        $project->status = 1;
        $project->save();

        $description = false;
        foreach ($project->attrs as $attr) {
            if ($attr->type == 'setupDescription') {
                $description = $attr;
                break;
            }
        }
        if (!$description) {
            Attribute::create([
                'name' => 'setupDescription',
                'project_id' => $request->id,
                'description' => $request->description,
                'type' => 'setupDescription'
            ]);
        } else {
            $description->description = $request->description;
            $description->save();
        }

        $link = route('order',['code'=>$project->code]);
        $body = " با سلام \n {$project->user->name} عزیز وضعیت پروژه شما به <span class='c-green'>دریافت اطلاعات</span> تغییر کرد.لطفا نسبت به تکمیل اطلاعات و پرداخت اقدام نمایید
 <div class='mt-3 text-start'><a href='$link' style='padding: 11px 18px;' class='me-2 btn btn--primary outline'>مشاهده پروژه</a></div>
 ";
        Notification::create([
            'user_id'=>auth()->id(),
            'for_user_id'=>$project->user_id,
            'for_id'=>$project->id,
            'data'=>$project->code,
            'title'=>'تغییر وضعیت پروژه شما',
            'body'=>$body,
            'icon'=>'monitor',
        ]);
        return redirect(route('admin.order', ['code' => $project->code]));
    }
    public function start(Request $request){
        $request->validate([
           'description'=>'required',
           'id'=>'required',
        ]);

        $project = Project::find($request->id);
        if (!$project) abort(404);

        $project->status = 3;
        $project->save();

        $description = false;
        foreach ($project->attrs as $attr) {
            if ($attr->type == 'startDescription') {
                $description = $attr;
                break;
            }
        }
        if (!$description) {
            Attribute::create([
                'name' => 'start description',
                'project_id' => $request->id,
                'description' => $request->description,
                'type' => 'startDescription'
            ]);
        } else {
            $description->description = $request->description;
            $description->save();
        }

        $haInfo = false;
        foreach ($project->attrs as $attr) {
            if ($attr->type == 'startDate') {
                $haInfo = $attr;
                break;
            }
        }
        if (!$haInfo) {
            Attribute::create([
                'name' => 'start',
                'value' => 'start',//process
                'description' => 'start',
                'type' => 'startDate',
                'project_id' => $project->id,
            ]);
        }


        $link = route('order',['code'=>$project->code]);
        $body = " با سلام \n {$project->user->name} عزیز وضعیت پروژه شما به <span class='c-green'>درحال انجام</span> تغییر کرد.
 <div class='mt-3 text-start'><a href='$link' style='padding: 11px 18px;' class='me-2 btn btn--primary outline'>مشاهده پروژه</a></div>
 ";
        Notification::create([
            'user_id'=>auth()->id(),
            'for_user_id'=>$project->user_id,
            'for_id'=>$project->id,
            'data'=>$project->code,
            'title'=>'تغییر وضعیت پروژه شما',
            'body'=>$body,
            'icon'=>'monitor',
        ]);
        return redirect(route('admin.order', ['code' => $project->code]));
    }

    public function sendDemo(Request $request)
    {
        $request->validate([
            'info' => ['required'],
            'type' => ['required'],
            'url' => ['required'],
        ]);
        $p = Project::find($request->project_id);
        if (!$p) abort(404);
        $p->status = 4;
        $p->save();

        $type = 'demo';
        $haInfo = false;
        foreach ($p->attrs as $attr) {
            if ($attr->type == $type) {
                $haInfo = $attr;
                break;
            }
        }
        if (!$haInfo) {
            Attribute::create([
                'name' => 'demo web',
                'project_id' => $request->project_id,
                'description' => $request->info,
                'value' => $request->url,
                'type' => $type
            ]);
        } else {
            $haInfo->description = $request->info;
            $haInfo->value = $request->url;
            $haInfo->save();
        }


        $link = route('order',['code'=>$p->code]);
        $body = " با سلام \n {$p->user->name} عزیز وضعیت پروژه شما به <span class='c-green'>ارسال دمو</span> تغییر کرد.لطفا نسبت به چک دمو پروژه اقدام نمایید
 <div class='mt-3 text-start'><a href='$link' style='padding: 11px 18px;' class='me-2 btn btn--primary outline'>مشاهده پروژه</a></div>
 ";
        Notification::create([
            'user_id'=>auth()->id(),
            'for_user_id'=>$p->user_id,
            'for_id'=>$p->id,
            'data'=>$p->code,
            'title'=>'تغییر وضعیت پروژه شما',
            'body'=>$body,
            'icon'=>'monitor',
        ]);
        return redirect(route('admin.order', ['code' => $p->code]));
    }

    public function finish(Request $request){

        $request->validate([
            'description' => ['required'],
            'web' => ['required'],
            'web_user' => ['required'],
            'web_pass' => ['required'],
            'host' => ['required'],
            'host_user' => ['required'],
            'host_pass' => ['required'],
            'email_info' => ['required'],
            'email_admin' => ['required'],
        ]);


        $p = Project::find($request->project_id);
        if (!$p) abort(404);
        $p->status = 5;
        $p->save();

        $type = 'finish';
        $haInfo = false;
        foreach ($p->attrs as $attr) {
            if ($attr->type == $type) {
                $haInfo = $attr;
                break;
            }
        }
        if (!$haInfo) {
            Attribute::create([
                'name' => 'finish web',
                'project_id' => $request->project_id,
                'description' => $request->description,
                'value' => json_encode($request->email_info),
                'value2' => json_encode($request->email_admin),
                'type' => $type
            ]);
        } else {
            $haInfo->description = $request->description;
            $haInfo->value = $request->email_info;
            $haInfo->value2 = $request->email_admin;
            $haInfo->save();
        }
        $access = $p->access;
        if ($access){
            $access->update([
                'web'=>$request->web,
                'web_username'=>$request->web_user,
                'web_password'=>$request->web_pass,
                'host'=>$request->host,
                'host_username'=>$request->host_user,
                'host_password'=>$request->host_pass,
            ]);
        }else{
            Access::create([
                'project_id'=>$p->id,
                'web'=>$request->web,
                'web_username'=>$request->web_user,
                'web_password'=>$request->web_pass,
                'host'=>$request->host,
                'host_username'=>$request->host_user,
                'host_password'=>$request->host_pass,
            ]);
        }

        $link = route('order',['code'=>$p->code]);
        $body = " با سلام \n {$p->user->name} عزیز وضعیت پروژه شما به <span class='c-green'>تحویل پروژه</span> تغییر کرد.اطلاعات دسترسی سایت شما ارسال گردید.
 <div class='mt-3 text-start'><a href='$link' style='padding: 11px 18px;' class='me-2 btn btn--primary outline'>مشاهده پروژه</a></div>
 ";
        Notification::create([
            'user_id'=>auth()->id(),
            'for_user_id'=>$p->user_id,
            'for_id'=>$p->id,
            'data'=>$p->code,
            'title'=>'تغییر وضعیت پروژه شما',
            'body'=>$body,
            'icon'=>'monitor',
        ]);
        return redirect(route('admin.order', ['code' => $p->code]));
    }
}

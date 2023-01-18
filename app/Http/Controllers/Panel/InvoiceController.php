<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Project;
use Carbon\Carbon;
use Evryn\LaravelToman\Facades\Toman;
use Illuminate\Http\Request;
use Evryn\LaravelToman\CallbackRequest;

class InvoiceController extends Controller
{
    public function pay($id){
        $invoice_id = $id;
        $invoice = Invoice::find($invoice_id);
        if (!$invoice || $invoice->status==1) abort(500);
        $request = Toman::amount($invoice->amount)
             ->description($invoice->info)
             ->callback(route('invoice.callback'))
             ->mobile(auth()->user()->mobile)
            // ->email('amirreza@example.com')
            ->request();

        if ($request->successful()) {
            // Store created transaction details for verification
            $transactionId = $request->transactionId();
            $invoice->authority = $transactionId;
            $invoice->save();
            // Redirect to payment URL
            return $request->pay();
        }

        if ($request->failed()) {
            return redirect(route('order',['code'=>$invoice->project->code]));
        }
    }

    public function callback(CallbackRequest $request){
        $Authority = Request::capture()->get('Authority');
        $invoice = Invoice::where('authority',$Authority)->first();
        if (!$invoice) abort(500);

        $payment = $request->amount($invoice->amount)->verify();

        if ($payment->successful()) {
            // Store the successful transaction details
            $referenceId = $payment->referenceId();
            $invoice->pay = $referenceId;
            $invoice->status = 1;
            $invoice->pay_date = Carbon::now();
            $invoice->save();
            $project = $invoice->project;
            if ($invoice->data==1)
            {
                $project->status = 2;
                $project->save();
            }
            session(['status'=>'با موفقیت پرداخت شد']);
            return redirect(route('order',['code'=>$project->code]));
        }

        if ($payment->alreadyVerified()) {
            session(['status'=>'قبلا پرداخت شده است']);
            return redirect(route('order',['code'=>$invoice->project->code]));
        }

        if ($payment->failed()) {
            $invoice->status = 2;
            $invoice->save();
            return redirect(route('order',['code'=>$invoice->project->code]));

        }
    }
}

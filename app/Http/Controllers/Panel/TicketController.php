<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketStoreRequest;
use App\Models\Message;
use App\Models\Project;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TicketController extends Controller
{
    public function list(){
        Ticket::where('user_id',auth()->id())->update([
            'new'=>false
        ]);
        $tickets = Ticket::where('user_id',auth()->id())->orderBy('created_at','desc')->paginate(5);
        $tComing = Ticket::where([['user_id',auth()->id()],['status',0]])->count();
        $tProcess = Ticket::where([['user_id',auth()->id()],['status',1]])->count();
        $tOk = Ticket::where([['user_id',auth()->id()],['status',2]])->count();
        $tFinish = Ticket::where([['user_id',auth()->id()],['status',3]])->count();
        return Inertia::render('Panel/Tickets',[
            'tickets'=>$tickets,
            'tComing'=>$tComing,
            'tProcess'=>$tProcess,
            'tOk'=>$tOk,
            'tFinish'=>$tFinish
        ]);
    }

    public function view($code){
        $ticket = Ticket::where([['user_id',auth()->id()],['id',$code-1200]])->first();
        if (!$ticket) abort(404);
        $messages = Message::orderBy('created_at','desc')->where('ticket_id',$ticket->id)->get();
        return Inertia::render('Panel/Ticket',[
            'ticket'=>$ticket,
            'messages'=>$messages
        ]);
    }

    public function create(Request $request){
        $project = Project::find($request->project);
        return Inertia::render('Panel/TicketCreate',[
            'project'=>$project
        ]);
    }

    public function store(TicketStoreRequest $request){

        $user_id = auth()->id();
        $ticket = new Ticket();
        $ticket->title = $request->title;
        $ticket->dep = $request->dep;
        $ticket->user_id = $user_id;
        $ticket->starter_id = $user_id;
        $ticket->project_id = $request->project_id;

        $ticket->save();

        $message = new Message();
        $message->ticket_id = $ticket->id;
        $message->user_id = $user_id;
        $message->text = $request->text;
        if ($request->hasFile('file')){
            $path = $this->upload($request->file('file'));
            $message->file = $path;
        }
        $message->save();

        return redirect(route('ticket.view',['code'=>$ticket->code]));
    }

    public function reply(Request $request){
        $request->validate([
            'text' => ['required', 'max:5000','min:10'],
            'ticketId' => ['required'],
        ]);

        $ticket = Ticket::where([['user_id',auth()->id()],['id',$request->ticketId]])->first();
        if (!$ticket) abort(500);


        $message = new Message();
        $message->ticket_id = $ticket->id;
        $message->text = $request->text;
        $message->user_id = auth()->id();
        if ($request->hasFile('file')){
            $path = $this->upload($request->file('file'));
            $message->file = $path;
        }
        $message->save();

        return redirect(route('ticket.view',['code'=>$ticket->code]));
    }

    public function status(Request $request){
        $ticket = Ticket::where([['id'=>$request->id],['user_id',auth()->id()]]);
        if (!$ticket) abort(500);
        $ticket->status = $request->status;
        $ticket->save();
        return redirect(route('admin.ticket.view',['code'=>$ticket->code]));
    }
}

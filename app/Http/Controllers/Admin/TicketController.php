<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TicketStoreRequest;
use App\Models\Message;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TicketController extends Controller
{
    public function list(){
        $tickets = Ticket::where('user_id',auth()->id())->paginate(5);
        $tComing = Ticket::where([['user_id',auth()->id()],['status',0]])->count();
        $tProcess = Ticket::where([['user_id',auth()->id()],['status',1]])->count();
        $tOk = Ticket::where([['user_id',auth()->id()],['status',2]])->count();
        $tFinish = Ticket::where([['user_id',auth()->id()],['status',3]])->count();
        return Inertia::render('Admin/Tickets',[
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
        $user = User::find($ticket->user_id);
        return Inertia::render('Admin/Ticket',[
            'ticket'=>$ticket,
            'messages'=>$messages,
            'user'=>$user
        ]);
    }

    public function create(){
        return Inertia::render('Panel/TicketCreate');
    }

    public function store(TicketStoreRequest $request){

        $user_id = auth()->id();
        $ticket = new Ticket();
        $ticket->title = $request->title;
        $ticket->dep = $request->dep;
        $ticket->user_id = $user_id;
        $ticket->starter_id = $user_id;
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

        return redirect(route(''));
    }

    public function reply(Request $request){
        $request->validate([
            'text' => ['required', 'max:5000','min:10'],
            'ticketId' => ['required'],
        ]);

        $ticket = Ticket::find($request->ticketId);
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

        return redirect(route('admin.ticket.view',['code'=>$ticket->code]));
    }

    public function status(Request $request){
        $ticket = Ticket::find($request->id);
        if (!$ticket) abort(500);
        $ticket->status = $request->status;
        $ticket->save();
        return redirect(route('admin.ticket.view',['code'=>$ticket->code]));
    }
}

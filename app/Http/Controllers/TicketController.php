<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\TicketCreated;
use App\Mail\TicketClosed;
use App\Models\TicketReplie;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    public function allTickets(){
        if(Auth::user()->type == 1){
            $tickets = Ticket::latest()->paginate(10);
        }else{
            $tickets = Ticket::where('user_id', Auth::user()->id)->latest()->paginate(10);
        }
        return view('tickets.all-tickets', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create-ticket');
    }

    public function store(Request $request)
    {

        // Check if the authenticated user's type is 1
        if (Auth::user()->type === 1) {
            return redirect()->back()->with('error', 'Ticket creation is only allowed for customers.');
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',            
            'priority' => 'required|string',
        ]);

        // Create a new ticket
        $validatedData['user_id'] = Auth::id();        
        $ticket = Ticket::create($validatedData);

        // send mail to admin 
        $admin = User::where('type', 1)->first();
           if ($admin) {
            Mail::to($admin->email)->send(new TicketCreated($ticket));
           }

        return redirect()->route('tickets.all')->with('success', 'Ticket created successfully!');
    }

    public function adminTicketDelete($id){
        Ticket::find($id)->delete();
        return redirect()->route('tickets.all')->with('success', 'Ticket deleted successfully!');
    }
    
    public function adminTicketView($id){
      $ticket = Ticket::findOrFail($id);

      if ($ticket->status == 0) {
        $ticket->update(['status' => "1"]); // Correctly updating status
    }

      return view('tickets.ticket-view', compact('ticket'));
    }

    public function replyToTicket(Request $request, $id)
    {
        // Validate the reply
        $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        // Find the ticket
        $ticket = Ticket::findOrFail($id);

        // Ensure ticket is open
        if ($ticket->status == 0) {
            return redirect()->back()->with('error', 'Replies can only be made to open tickets.');
        }

        // Save the reply (you can store replies in a TicketReplies model or update the ticket)
        TicketReplie::create([
            'ticket_id' => $ticket->id,
            'user_id' => $ticket->user_id,           
            'reply' => $request->reply,           
        ]);

        return redirect()->route('admin.ticket.view', $ticket->id)->with('success', 'Reply sent successfully.');
    }
    
    public function adminTicketClose($id)
    {

        $ticket = Ticket::findOrFail($id);
        $ticket->update(['status' => "2"]);
        $user = User::find($ticket->user_id);
        Mail::to($user->email)->send(new TicketClosed($ticket));

    return redirect()->route('tickets.all')->with('success', 'Ticket closed successfully and user notified!');
    }

}

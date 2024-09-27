<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket;
    /**
     * Create a new message instance.
     */
    public function __construct($ticket)
    {
        $this->ticket = $ticket;
    }
    

    public function build()
    {
        return $this->subject('New Ticket Created')
                    ->view('emails.ticket_created');
    }

}

<h1>New Ticket Created</h1>
<p>A new ticket has been created by a customer:</p>
<ul>
    <li><strong>Title:</strong> {{ $ticket->title }}</li>   
    <li><strong>Priority:</strong> {{ ucfirst($ticket->priority) }}</li>
    <li><strong>Status:</strong> {{ $ticket->status == 0 ? 'Pending' : 'Open' }}</li>
</ul>

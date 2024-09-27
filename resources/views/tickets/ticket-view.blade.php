<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <h1 class="text-2xl font-bold mb-4">Ticket Details</h1>

                        <div class="mb-4">
                            <strong>Title:</strong> {{ $ticket->title }}
                            <strong>Priority:</strong> {{ ucfirst($ticket->priority) }}
                            <strong>Status:</strong> 
                            @switch($ticket->status)
                                @case(0)
                                    Pending
                                    @break
                                @case(1)
                                    Open
                                    @break
                                @case(2)
                                    Closed
                                    @break
                                @default
                                    Unknown
                            @endswitch
                            <strong>Created At:</strong> {{ $ticket->created_at->format('d M Y') }}
                        </div>       
                          <!-- Display previous replies with scrollbar -->
                          <div class="mt-6">
                            <h2 class="text-xl font-bold mb-4">Previous Replies</h2>
                            <div class="overflow-y-auto h-64 border border-gray-300 rounded-md p-4">
                                <!-- Assuming you have a relationship set up to get replies -->
                                @foreach($ticket->replies as $reply)                              
                                    <div class="mb-4 p-4 bg-gray-100 rounded-lg shadow-sm">
                                        <strong>Admin Reply:</strong>
                                        <p class="mt-2">{{ $reply->reply }}</p>
                                        <small class="text-gray-500">{{ $reply->created_at->format('d M Y, H:i') }}</small>
                                    </div>
                                @endforeach

                                @if($ticket->replies->isEmpty())
                                    <p class="text-gray-500">No replies yet.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Display the reply form only if the status is 'Open' (1) -->
                        @if($ticket->status == 1)
                            <div class="mt-6">
                                <h2 class="text-xl font-bold mb-4">Reply to Ticket</h2>
                                <form action="{{ route('tickets.reply', $ticket->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="reply" class="block text-sm font-medium text-gray-700">Reply:</label>
                                        <textarea id="reply" name="reply" rows="4" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" required></textarea>
                                    </div>

                                    <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                        Send Reply
                                    </button>
                                </form>
                            </div>
                        @else
                            <p class="text-gray-500">Ticket is closed. No replies can be made.</p>
                        @endif                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

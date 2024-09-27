<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <h1 class="text-2xl font-bold mb-4">All Tickets</h1>    

                        @if($tickets->isEmpty())
                            <p class="text-gray-500">No tickets available.</p>
                        @else
                            <table class="min-w-full table-auto border-collapse border border-gray-300">
                                <thead>
                                    <tr>
                                        <th class="border border-gray-300 px-4 py-2">ID</th>
                                        <th class="border border-gray-300 px-4 py-2">Title</th>
                                        <th class="border border-gray-300 px-4 py-2">Priority</th>
                                        <th class="border border-gray-300 px-4 py-2">Description</th>
                                        <th class="border border-gray-300 px-4 py-2">Status</th>
                                        <th class="border border-gray-300 px-4 py-2">Created At</th>
                                        @if (Auth::user()->type == 1)
                                        <th class="border border-gray-300 px-4 py-2">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tickets as $ticket)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2">{{ $ticket->id }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $ticket->title }}</td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            {{ \Str::ucfirst(\Str::lower($ticket->priority)) }}
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            {{ $ticket->description }} 
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2">
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
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $ticket->created_at->format('d M Y') }}</td>
                                        <td class="border border-gray-300 px-4 py-5">
                                        @if (Auth::user()->type == 1)                                        
                                              <a type="button" href="{{ route('admin.delete.ticket', $ticket->id) }}" 
                                              class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mr-2">
                                                     Delete
                                            </a>                                            
                                        @endif

                                        @if ($ticket->status == 1 || $ticket->status == 0) 
                                        <a type="button" href="{{ route('admin.ticket.view',  $ticket->id) }}" 
                                              class="gap-2 bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-2 rounded mr-2">
                                               View
                                            </a>                                      
                                        @else
                                        Closed     
                                        @endif     

                                        @if (Auth::user()->type == 1) 
                                            @if ($ticket->status == 1)
                                            <a type="button" href="{{ route('admin.ticket.close',  $ticket->id) }}" 
                                                class="gap-2 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mr-2">
                                                Close
                                                </a>  
                                            @endif
                                        @endif       

                                        </td>                       

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination links -->
                            <div class="mt-4">
                                {{ $tickets->links() }}
                            </div>
                        @endif
                  
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

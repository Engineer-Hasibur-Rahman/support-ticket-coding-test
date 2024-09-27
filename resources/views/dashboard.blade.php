<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to Your Dashboard - Ticket Management System') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold">Hello, {{ Auth::user()->name }}!</h1>
                    <p class="mt-2">Your email: {{ Auth::user()->email }}</p>

                
                    <div class="mt-4">
                        @if (Auth::user()->type == 0)
                            <p>Welcome to the customer dashboard! You can view and manage your tickets here.</p>
                        @elseif (Auth::user()->type == 1)
                            <p>Welcome to the admin dashboard! You can manage all user tickets and oversee the ticket management system.</p>
                        @else
                            <p>You can manage your account and tickets here.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <h1 class="text-2xl font-bold mb-4">Create a New Ticket</h1>

                        <form action="{{ route('tickets.store') }}" method="POST">
                            @csrf

                              <!-- Display All Errors at the Top -->
                            <x-input-error :messages="$errors->all()" class="mb-4" />

                            <div class="mb-4">
                                <label for="title" class="block text-gray-700">Title</label>
                                <input type="text" name="title" id="title" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="block text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="priority" class="block text-gray-700">Priority</label>
                                <select name="priority" id="priority" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                    <option value="urgent">Urgent</option>
                                </select>
                            </div>                        
                            <x-primary-button class="ms-3">
                                {{ __('Create Ticket') }}
                            </x-primary-button>                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

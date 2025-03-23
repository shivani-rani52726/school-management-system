<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Notes') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <h2 class="text-3xl font-bold mb-6 text-center">Create Your Notes</h2>

        @if(session('success'))
            <div class="bg-green-200 text-green-700 p-3 rounded-lg text-center mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('notes.save') }}" method="POST" class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
            @csrf
            <label class="block text-lg font-semibold mb-2">Note Title:</label>
            <input type="text" name="title" class="w-full border-gray-300 rounded-lg p-2 mb-4" placeholder="Enter title" required>

            <label class="block text-lg font-semibold mb-2">Note Content:</label>
            <textarea name="content" rows="5" class="w-full border-gray-300 rounded-lg p-2 mb-4" placeholder="Write your notes here..." required></textarea>

            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600">
                Save Notes
            </button>
        </form>
    </div>
</x-app-layout>

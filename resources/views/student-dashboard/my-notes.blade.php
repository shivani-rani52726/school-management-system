<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Notes') }}
            </h2>
            <a href="{{ route('notes.create') }}" class="bg-green-600 text-white text-sm px-4 py-2 rounded-lg hover:bg-green-700 transition">
                + Create Notes
            </a>
        </div>
    </x-slot>

    <!-- Success Message -->
    @if (session('success'))
        <div id="successMessage" class="bg-green-500 text-white px-4 py-2 rounded-lg text-center w-1/2 mx-auto mt-4 shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mx-auto px-4 py-6">
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">My Saved Notes</h2>

        @if ($notes->isEmpty())
            <p class="text-center text-gray-500">No notes found. Start creating one!</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($notes as $note)
                    <div class="bg-white shadow-md hover:shadow-lg p-5 rounded-lg relative transition duration-300">
                        <!-- Delete Button -->
                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST" class="absolute top-3 right-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-lg"
                                onclick="return confirm('Are you sure you want to delete this note?');">
                                &times;
                            </button>
                        </form>

                        <h3 class="text-xl font-semibold text-gray-800">{{ $note->title }}</h3>

                        <!-- Content Section -->
                        <div class="text-gray-600 mt-2 overflow-hidden max-h-20 transition-all duration-300 ease-in-out" id="content-{{ $note->id }}">
                            {{ $note->content }}
                        </div>

                        <!-- Read More Button -->
                        <button onclick="toggleContent({{ $note->id }})"
                            class="text-blue-500 hover:text-blue-700 mt-3 font-medium transition">
                            Read More
                        </button>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- JavaScript for Success Message & Read More -->
    <script>
        // Hide success message after 3 seconds
        setTimeout(() => {
            let successMessage = document.getElementById('successMessage');
            if (successMessage) {
                successMessage.style.opacity = '0';
                setTimeout(() => successMessage.style.display = 'none', 500);
            }
        }, 3000);

        // Toggle Read More Functionality
        function toggleContent(id) {
            let contentDiv = document.getElementById('content-' + id);
            if (contentDiv.classList.contains('max-h-20')) {
                contentDiv.classList.remove('max-h-20');
                contentDiv.classList.add('max-h-full', 'overflow-auto');
            } else {
                contentDiv.classList.add('max-h-20');
                contentDiv.classList.remove('max-h-full', 'overflow-auto');
            }
        }
    </script>
</x-app-layout>

<x-app-layout>
    <h2 class="text-3xl font-bold text-center my-6">➕ Add New Question</h2>
    <div class="container mx-auto px-4">
        <form action="{{ route('quiz.store') }}" method="POST">
            @csrf
            <label>Question:</label>
            <input type="text" name="question" class="w-full border px-3 py-2 rounded"><br>

            <label>Option A:</label>
            <input type="text" name="option_a" class="w-full border px-3 py-2 rounded"><br>

            <label>Option B:</label>
            <input type="text" name="option_b" class="w-full border px-3 py-2 rounded"><br>

            <label>Option C:</label>
            <input type="text" name="option_c" class="w-full border px-3 py-2 rounded"><br>

            <label>Option D:</label>
            <input type="text" name="option_d" class="w-full border px-3 py-2 rounded"><br>

            <label>Correct Option (A/B/C/D):</label>
            <input type="text" name="correct_option" class="w-full border px-3 py-2 rounded"><br>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-4">Save</button>
        </form>
    </div>
</x-app-layout>

<x-app-layout>
    <h2 class="text-3xl font-bold text-center my-6">📚 Start Preparing</h2>

    <div class="text-center mb-4">
        <a href="{{ route('quiz.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">➕ Add Question</a>
    </div>

    <form action="{{ route('quiz.evaluate') }}" method="POST">
        @csrf
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($questions as $question)
                    <div class="bg-white shadow-lg p-4 rounded-lg">
                        <h3 class="text-lg font-semibold">{{ $question->question }}</h3>

                        <label><input type="radio" name="answer_{{ $question->id }}" value="option_a"> {{ $question->option_a }}</label><br>
                        <label><input type="radio" name="answer_{{ $question->id }}" value="option_b"> {{ $question->option_b }}</label><br>
                        <label><input type="radio" name="answer_{{ $question->id }}" value="option_c"> {{ $question->option_c }}</label><br>
                        <label><input type="radio" name="answer_{{ $question->id }}" value="option_d"> {{ $question->option_d }}</label><br>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="text-center mt-6">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded">Submit Quiz</button>
        </div>
    </form>
</x-app-layout>

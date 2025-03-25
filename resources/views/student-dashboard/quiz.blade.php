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
                    <div class="bg-white shadow-lg p-4 rounded-lg relative" id="quiz-card-{{ $question->id }}">
                        
                        <!-- ❌ Delete Button (Calls Backend) -->
                        <button type="button" onclick="deleteQuestion({{ $question->id }})"
                            class="absolute top-2 right-2 text-red-500 hover:text-red-700">
                            ❌
                        </button>

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

    <!-- 🛠️ JavaScript to Delete Question via AJAX -->
    <script>
        function deleteQuestion(questionId) {
            if (!confirm("Are you sure you want to delete this question?")) {
                return;
            }

            fetch(`/quiz/${questionId}/delete`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let card = document.getElementById('quiz-card-' + questionId);
                    if (card) {
                        card.style.transition = "opacity 0.3s ease-out";
                        card.style.opacity = "0";
                        setTimeout(() => card.remove(), 300);
                    }
                } else {
                    alert("Error deleting question!");
                }
            })
            .catch(error => console.error('Error:', error));
        }
    </script>
</x-app-layout>

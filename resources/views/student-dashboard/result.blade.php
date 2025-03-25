<x-app-layout>
    <h2 class="text-3xl font-bold text-center my-6">🎯 Quiz Results</h2>

    <div class="text-center mb-4">
        <h3 class="text-2xl font-semibold">Your Score: 
            <span class="text-blue-600">{{ $score }}</span> / {{ $totalQuestions }}
        </h3>
        <p class="mt-2 text-lg {{ $score >= ($totalQuestions / 2) ? 'text-green-600' : 'text-red-600' }}">
            {{ $score >= ($totalQuestions / 2) ? '🎉 Great Job! You Passed!' : '❌ Better Luck Next Time!' }}
        </p>
        <a href="{{ route('quiz.index') }}" class="mt-4 inline-block bg-indigo-500 text-white py-2 px-4 rounded hover:bg-indigo-600">
            Retake Quiz
        </a>
    </div>

    <div class="container mx-auto px-4">
        <h2 class="text-2xl font-bold mt-6">Your Answers:</h2>
        <div class="mt-4">
            @foreach($results as $result)
                <div class="bg-gray-100 p-4 rounded-lg mb-4 relative">
                    <h3 class="font-semibold">{{ $result['question'] }}</h3>

                    <p class="mt-2">
                        ✅ <strong class="text-green-600">Correct Answer:</strong> {{ $result['correct_answer'] }}
                    </p>

                    @if ($result['is_correct'])
                        <p class="mt-1 text-green-500 font-bold">
                            ✔️ Your Answer: {{ $result['user_answer'] }} (Correct!)  
                            <span class="text-blue-600">(+1 Mark)</span>
                        </p>
                    @else
                        <p class="mt-1 text-red-500 font-bold">
                            ❌ Your Answer: {{ $result['user_answer'] }} (Wrong!)  
                            <span class="text-red-600">(-0 Mark)</span>
                        </p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

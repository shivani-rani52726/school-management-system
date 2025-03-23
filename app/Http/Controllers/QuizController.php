<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class QuizController extends Controller
{
    // 📝 Show Quiz Page
    public function index()
    {
        $questions = Question::all();
        return view('student-dashboard.quiz', compact('questions'));
    }

    // 📝 Show Create Form
    public function create()
    {
        return view('student-dashboard.create-quiz');
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'option_a' => 'required',
            'option_b' => 'required',
            'option_c' => 'required',
            'option_d' => 'required',
            'correct_option' => 'required',
        ]);
    
        Question::create([
            'question' => $request->question,
            'option_a' => $request->option_a,
            'option_b' => $request->option_b,
            'option_c' => $request->option_c,
            'option_d' => $request->option_d,
            'correct_option' => $request->correct_option,
        ]);
    
        return redirect()->route('quiz.index')->with('success', 'Question Added!');
    }
    

    // 📝 Delete Question
    public function destroy($id)
    {
        Question::find($id)->delete();
        return redirect()->route('quiz.index')->with('success', 'Question Deleted!');
    }

    // 📝 Evaluate Quiz
    public function evaluate(Request $request)
    {
        $score = 0;
        $totalQuestions = Question::count();
        $questions = Question::all();
        $results = [];
    
        foreach ($questions as $question) {
            $userAnswerKey = $request->input('answer_' . $question->id);
    
            // ✅ Agar user ne koi answer diya hai tabhi check karein
            if ($userAnswerKey) {
                // ✅ Correct option ka **actual text** nikalein
                $correctOptionKey = $question->correct_option; // e.g., "option_a"
                $correctAnswer = $question->$correctOptionKey; // e.g., "Paris"
    
                // ✅ Answer check karein (Direct value compare karein)
                $isCorrect = ($userAnswerKey === $correctOptionKey);
    
                if ($isCorrect) {
                    $score++;
                }
    
                $results[] = [
                    'question' => $question->question,
                    'user_answer' => $question->$userAnswerKey ?? 'Not Answered',
                    'correct_answer' => $correctAnswer,
                    'is_correct' => $isCorrect,
                ];
            } else {
                $results[] = [
                    'question' => $question->question,
                    'user_answer' => 'Not Answered',
                    'correct_answer' => $question->{$question->correct_option},
                    'is_correct' => false,
                ];
            }
        }
    
        return view('student-dashboard.result', compact('score', 'totalQuestions', 'results'));
    }
    

    
    
    
}

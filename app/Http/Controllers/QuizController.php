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
    // 📝 Delete Question (AJAX Support)
    public function destroy($id)
    {
        $question = Question::find($id);

        if ($question) {
            $question->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'Question not found'], 404);
        }
    }


    // 📝 Evaluate Quiz
    public function evaluate(Request $request)
    {
        $score = 0;
        $totalQuestions = Question::count();
        $questions = Question::all();
        $results = [];
    
        foreach ($questions as $question) {
            $userAnswerRaw = request("answer_" . $question->id); // Jo answer user ne select kiya
            $userAnswer = strtolower(trim($userAnswerRaw)); // Normalize user input
            $correctAnswer = strtolower(trim($question->correct_option)); // ✅ Corrected column name
    
            // Convert 'option_a', 'option_b', etc. to 'A', 'B', etc.
            $answerMapping = [
                'option_a' => 'A',
                'option_b' => 'B',
                'option_c' => 'C',
                'option_d' => 'D',
            ];
    
            // Agar user ka answer mapping wale format me hai to convert kare
            if (isset($answerMapping[$userAnswer])) {
                $userAnswer = $answerMapping[$userAnswer];
            }
    
            // Check if the answer is correct
            $isCorrect = $userAnswer === strtolower($correctAnswer);
    
            // Save result for display
            $results[] = [
                'question' => $question->question,
                'correct_answer' => strtoupper($correctAnswer), // ✅ Capitalize correct answer
                'user_answer' => strtoupper($userAnswerRaw), // ✅ Capitalize user answer
                'is_correct' => $isCorrect, // True/False
            ];
    
            // Agar answer sahi hai to score +1 kare
            if ($isCorrect) {
                $score++;
            }
        }
    
        return view('student-dashboard.result', compact('score', 'totalQuestions', 'results'));
    }
    
    
    
}

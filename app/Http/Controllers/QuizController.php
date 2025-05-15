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
        // dd($request);
        $score = 0;
        $totalQuestions = Question::count();
        $questions = Question::all();
        $results = [];

        $answerKeyMap = [
            'option_a' => 'A',
            'option_b' => 'B',
            'option_c' => 'C',
            'option_d' => 'D',
        ];
    
        foreach ($questions as $question) {
            // $userQuestionAnswerRaw = request("answer_" . $question->id); // Jo answer user ne select kiya
            // $userAnswer = strtolower(trim($userQuestionAnswerRaw)); // Normalize user input
            $userAnswerKey = request("answer_" . $question->id);
            $userAnswerValue = strtolower(trim($question->{$userAnswerKey}));

            $correctAnswerValue = strtolower(trim($question->correct_option)); // ✅ Corrected column name
            $isCorrect = $userAnswerValue == $correctAnswerValue;
            // dd($isCorrect);
            // Convert 'option_a', 'option_b', etc. to 'A', 'B', etc.
         
            // dd($answerMapping);



            $correctAnswerKey = collect([
                'option_a' => $question->option_a,
                'option_b' => $question->option_b,
                'option_c' => $question->option_c,
                'option_d' => $question->option_d,
            ])->search(function($value) use ($correctAnswerValue){
                return strtolower(trim($value)) == $correctAnswerValue;
            });

            $userAnswerLabel = $answerKeyMap[$userAnswerKey] ?? 'N/A'; 
            $correctAnswerLabel = $answerKeyMap[$correctAnswerKey] ?? 'N/A';
            // dd($correctAnswerLabel);
             $results[] = [
                'question' => $question->question,
                'correct_answer' => $correctAnswerLabel, // ✅ Capitalize correct answer
                'user_answer' => $userAnswerLabel, // ✅ Capitalize user answer
                'is_correct' => $isCorrect, // True/False
            ];
            
            if($isCorrect){
                $score++;
            }
    
            // Agar user ka answer mapping wale format me hai to convert kare
            // if (isset($answerMapping[$userAnswer])) {
            //     $userkeyAnswer = $answerMapping[$userAnswer];
            // }
            
            // Check if the answer is correct
            // $isCorrect = $userAnswer == strtolower($userkeyAnswer);
    
            // Save result for display
            // $results[] = [
            //     'question' => $question->question,
            //     'correct_answer' => strtoupper($correctAnswer), // ✅ Capitalize correct answer
            //     'user_answer' => strtoupper($userQuestionAnswerRaw), // ✅ Capitalize user answer
            //     'is_correct' => $isCorrect, // True/False
            // ];
    
            // Agar answer sahi hai to score +1 kare
            // if ($isCorrect) {
            //     $score++;
            // }
        }


    
        return view('student-dashboard.result', compact('score', 'totalQuestions', 'results'));
    }
    
    
    
}

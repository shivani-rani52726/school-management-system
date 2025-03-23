<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

class ResultController extends Controller
{
    // 📝 Show All Results
    public function index()
    {
        $results = Result::all();
        return view('student-dashboard.results', compact('results'));
    }

    // 📝 Store New Result
    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required',
            'subject' => 'required',
            'marks_obtained' => 'required|integer',
            'total_marks' => 'required|integer',
        ]);

        Result::create($request->all());

        return redirect()->route('results.index')->with('success', 'Result Added!');
    }

    // 📝 Delete Result
    public function destroy($id)
    {
        Result::find($id)->delete();
        return redirect()->route('results.index')->with('success', 'Result Deleted!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\StudyMaterial;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function studyMaterials()
    {
        return view('student-dashboard.study-materials');
    }
    public function createNotes()
    {
        return view('student-dashboard.create-notes');
    }
    // Save Notes stude
    public function saveNotes(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Note::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('notes.myNotes')->with('success', 'Note saved successfully!');
    }
    public function myNotes()
    {
        $notes = Note::where('user_id', Auth::id())->latest()->get();
        return view('student-dashboard.my-notes', compact('notes'));
    }
 
  
}

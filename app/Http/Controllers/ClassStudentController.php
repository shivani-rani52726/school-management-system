<?php

namespace App\Http\Controllers;

use App\Models\classStudent;
use Illuminate\Http\Request;

class ClassStudentController extends Controller
{
    public function store(Request $req){
        // dd($req->all());
        $classRecord = new classStudent();
        $classRecord->class = $req->className;
        $classRecord->save();
        return redirect()->back()->with('success','Data submit successfully');
    }

    public function show() {
        $allClassRecord = classStudent::all();
        // dd($allClassRecord);
        return view('admin-panel.pages.class',compact('allClassRecord'));
    }

    public function update(Request $request) {
        $classRecord = classStudent::findOrFail($request->classId); 
        $classRecord->class = $request->className; 
        $classRecord->update(); 

        return redirect()->route('class');
    }

    public function destroy($uuid){
        $classNameDelete = classStudent::findOrFail($uuid);
        $classNameDelete->delete();
        return redirect()->back()->with('success','Data delete succesfully');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(classStudent $classStudent)
    {
        //
    }

   

  
}

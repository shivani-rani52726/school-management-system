<?php

namespace App\Http\Controllers;

use App\Models\classStudent;
use App\Models\subjectWithClass;
use Illuminate\Http\Request;

class SubjectWithClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $className = classStudent::all();
        $subjectWithClass = subjectWithClass::with('className')->get();
        return view('admin-panel.pages.subjectWithClass',compact('className', 'subjectWithClass'));
    }

   
   
    public function store(Request $request){

         $request->validate([
             'classId' => 'required',
             'subjectName'=> 'required',
         ]);

         $classStudent = new subjectWithClass();
         $classStudent->class = $request->classId;
         $classStudent->subject_name =$request->subjectName;
         $classStudent->save();
         return redirect()->back()->with('success','subject with class name add successfully');
     }

      /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid){
        $subjectWithClassDelete = subjectWithClass::findOrFail($uuid);
        $subjectWithClassDelete->delete();
        return redirect()->back()->with('success','data delete successfully');
    }

     /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $subjectWithClass = subjectWithClass::findOrFail($request->subjectId);
        $subjectWithClass->class = $request->classId;
        $subjectWithClass->subject_name = $request->subjectName;
        $subjectWithClass->update(); 

    
        return redirect()->route('subjects');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

   

    /**
     * Display the specified resource.
     */
    public function show(subjectWithClass $subjectWithClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(subjectWithClass $subjectWithClass)
    {
        //
    }

   

   
}

<?php

namespace App\Http\Controllers;

use App\Models\schoolDetails;
use App\Models\TeacherDetail;
use App\Models\teachersName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeachersNameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $teacherDetail = TeacherDetail::all();
        $schoolDetail = schoolDetails::all();

        $teacherWithSchoolName = teachersName::with('teacherDetail', 'schoolDetail')->get();
        // dd($teacherWithSchoolName);
        return view('admin-panel.pages.teachersName',compact('teacherDetail', 'schoolDetail','teacherWithSchoolName'));
    }

   
     public function store(Request $request){
        //  dd($request->all());

         $request->validate([
            'schoolId' => 'required',
            'teacherId' => 'required',
         ]);

         $teacherDetail = new teachersName();
         $teacherDetail->school_name = $request->schoolId;
         $teacherDetail->teacher_name = $request->teacherId;
         $teacherDetail->save();
         return redirect()->back()->with('success','teacher with school name add successfully');
     }

    public function update(Request $request) {
        $teacherWithSchool = teachersName::findOrFail($request->teacherWithSchoolId);
        $teacherWithSchool->school_name = $request->schoolId;
        $teacherWithSchool->teacher_name = $request->teacherId;
        $teacherWithSchool->update(); 

    
        return redirect()->route('teachers');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $teacherWithSchoolNameDelete = teachersName::findOrFail($uuid);
        $teacherWithSchoolNameDelete->delete();
        return redirect()->back()->with('success','data delete successfully');
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
    public function show(teachersName $teachersName)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(teachersName $teachersName)
    {
        //
    }

}

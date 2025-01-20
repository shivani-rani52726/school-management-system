<?php

namespace App\Http\Controllers;

use App\Models\TeacherDetail;
use Illuminate\Http\Request;

class TeacherDetailController extends Controller
{


     public function teacherDetailSubmit(Request $req){
        //  dd($req->all());
        $teacherRecord = new  TeacherDetail();
        $teacherRecord->teacher_name = $req->teacherName;
        $teacherRecord->teacher_school_name = $req->teacherSchoolName;
        $teacherRecord->teacher_class = $req->teacherClass;
        $teacherRecord->teacher_subject = $req->teacherSubject;
        $teacherRecord->aadhar_no = $req->aadhaarNo;
        $teacherRecord->contact_no = $req->contactNo;
        $teacherRecord->address = $req->teacherAddress;
        $teacherRecord->save();
        return redirect()->back()->with('success','Data submit successfully');
     }

    
    public function show(){
        $allTeacherRecord = TeacherDetail::all();
        // dd($allTeacherRecord);
        return view('admin-panel.pages.teacher_details',compact('allTeacherRecord'));
    }

     
    public function destroy($uuid) {
        $teacherDetailDelete = TeacherDetail::findOrFail($uuid);
        $teacherDetailDelete->delete();
        return redirect()->back()->with('success','Data delete succesfully');
    }

     
    public function edit(Request $uuid){
        $editTeacherDetail = TeacherDetail::findOrFail($uuid->teacherId);
        // dd($editTeacherDetail);
        return view('admin-panel.pages.editTeacherDetail',compact('editTeacherDetail')); 
    }

    public function update(Request $request){
        // dd($request);
        $teacherRecord = TeacherDetail::findOrFail($request->teacherId); 
        $teacherRecord->teacher_name = $request->teacherName; 
        $teacherRecord->teacher_school_name = $request->teacherSchoolName; 
        $teacherRecord->teacher_class = $request->teacherClass;
        $teacherRecord->teacher_subject = $request->teacherSubject;
        $teacherRecord->aadhar_no = $request->aadhaarNo;
        $teacherRecord->contact_no = $request->contactNo;
        $teacherRecord->address = $request->teacherAddress;
        $teacherRecord->update(); 

    
        return redirect()->route('teacher-details');
    }

    public function index()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

   


  
}

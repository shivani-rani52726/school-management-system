<?php

namespace App\Http\Controllers;

use App\Models\StudentDetail;
use Illuminate\Http\Request;

class StudentDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function studentDetailSubmit(Request $req){
        // dd($req->all());
        $studentRecord = new  StudentDetail();
        $studentRecord->stu_name = $req->studentName;
        $studentRecord->rollNo = $req->roll_No;
        $studentRecord->class = $req->stuClass;
        $studentRecord->father_name = $req->fatherName;
        $studentRecord->mother_name = $req->motherName;
        $studentRecord->aadhar_number = $req->aadhaarNo;
        $studentRecord->address = $req->stu_address;
        $studentRecord->contact_number = $req->contactNo;
        $studentRecord->save();
        return redirect()->back()->with('success','Data submit successfully');
    }

    public function show() {
        $allStudentRecord = StudentDetail::all();
        // dd($allStudentRecord);
        return view('admin-panel.pages.stu_details',compact('allStudentRecord'));
    }

    public function destroy($uuid) {
        $studentDetailDelete = StudentDetail::findOrFail($uuid);
        $studentDetailDelete->delete();
        return redirect()->back()->with('success','Data delete succesfully');
    }

    public function edit(Request $uuid){
        $editStudentDetail = StudentDetail::findOrFail($uuid->studentId);
        // dd($editStudentDetail);
        return view('admin-panel.pages.editStudentDetail',compact('editStudentDetail')); 
    }
    public function update(Request $request){
        // dd($request);
        $studentRecord = StudentDetail::findOrFail($request->studentId); 
        $studentRecord->stu_name = $request->studentName; 
        $studentRecord->rollNo = $request->roll_No; 
        $studentRecord->class = $request->stuClass;
        $studentRecord->father_name = $request->fatherName;
        $studentRecord->mother_name = $request->motherName;
        $studentRecord->aadhar_number = $request->aadhaarNo;
        $studentRecord->address = $request->stu_address;
        $studentRecord->contact_number = $request->contactNo;
        $studentRecord->update(); 

    
        return redirect()->route('student-details');
    }

    
    public function create()
    {
        //
    }

  
    public function store(Request $request)
    {
        //
    }

   
}

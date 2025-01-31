<?php

namespace App\Http\Controllers;

use App\Models\schoolDetails;
use Illuminate\Http\Request;

class SchoolDetailsController extends Controller
{

     /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req){
        // dd($req->all());
        $schoolRecord = new schoolDetails();
        $schoolRecord->school_name = $req->schoolName;
        $schoolRecord->principal_name = $req->principalName;
        $schoolRecord->city_name = $req->city;
        $schoolRecord->district_name = $req->district;
        $schoolRecord->contact_no = $req->contactNumber;
        $schoolRecord->school_email = $req->email;
        $schoolRecord->established_year = $req->establishedYear;
        $schoolRecord->school_website = $req->website;
        $schoolRecord->save();
        return redirect()->back()->with('success','Data submit successfully');
    }

    
    /**
     * Display the specified resource.
     */
    public function show() {
        $allSchoolRecord = schoolDetails::all();
        // dd($allSchoolRecord);
        return view('admin-panel.pages.school_details',compact('allSchoolRecord'));
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid) {
        $schoolDetailDelete = schoolDetails::findOrFail($uuid);
        $schoolDetailDelete->delete();
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
     * Update the specified resource in storage.
     */
    public function update(Request $request){
        // dd($request);
        $schoolRecord = schoolDetails::findOrFail($request->schoolId); 
        $schoolRecord->school_name = $request->schoolName; 
        $schoolRecord->principal_name = $request->principalName;
        $schoolRecord->city_name = $request->city;
        $schoolRecord->district_name = $request->district;
        $schoolRecord->contact_no = $request->contactNumber;
        $schoolRecord->school_email = $request->email;
        $schoolRecord->established_year = $request->establishedYear;
        $schoolRecord->school_website = $request->website;
        $schoolRecord->update(); 

    
        return redirect()->route('school-details');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(schoolDetails $schoolDetails)
    {
        //
    }

   

   
}

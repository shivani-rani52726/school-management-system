<?php

namespace App\Http\Controllers;

use App\Models\schoolDetails;
use App\Models\TeacherDetail;
use App\Models\teachersName;
use Illuminate\Http\Request;

class TeachersNameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $teacherDetail = TeacherDetail::all();
        $schoolDetail = schoolDetails::all();
        return view('admin-panel.pages.teachersName',compact('teacherDetail', 'schoolDetail'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, teachersName $teachersName)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(teachersName $teachersName)
    {
        //
    }
}

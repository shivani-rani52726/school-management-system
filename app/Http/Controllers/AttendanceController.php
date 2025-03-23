<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    // ✅ Attendance Records Show Karna
    public function index()
    {
        $attendanceRecords = Attendance::all(); // Sabhi attendance records fetch karo
        return view('student-dashboard.attendance', compact('attendanceRecords'));
    }

    // ✅ Attendance Add Karna
    public function create()
    {
        return view('student-dashboard.add-attendance');
    }

    // ✅ Attendance Store Karna
    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required',
            'date' => 'required|date',
            'subject' => 'required',
            'status' => 'required|in:Present,Absent',
        ]);

        Attendance::create($request->all());

        return redirect()->route('attendance.view')->with('success', 'Attendance Added Successfully!');
    }
}


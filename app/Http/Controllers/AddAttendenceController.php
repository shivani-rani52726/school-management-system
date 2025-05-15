<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Attendance;
use App\Models\classStudent;
use Illuminate\Http\Request;
use App\Models\StudentDetail;
use Illuminate\Support\Facades\Log;

class AddAttendenceController extends Controller
{

    public function index()
    {
        $className = classStudent::all();
        $studentDetail = StudentDetail::all();
        return view('admin-panel.pages.add-attendence', compact('className', 'studentDetail'));
    }
    public function addAttendence(Request $request)
    {
        // Validate the request data
        $request->validate([
            'student_name' => 'required|string|max:255',
            'rollNo' => 'required|string|max:255',
            'date' => 'required|date',
            'status' => 'required|in:Present,Absent',
        ]);

        // Create a new attendance record
        $attendance = new Attendance();
        $attendance->student_name = $request->student_name;
        $attendance->rollNo = $request->rollNo;
        $attendance->date = $request->date;
        $attendance->status = $request->status;
        $attendance->save();

        return redirect()->back()->with('success', 'Attendance recorded successfully.');
    }

    public function getStudents($class_uuid)
    {
        // dd($class_uuid);
        $students = StudentDetail::where('class', $class_uuid)->get();
        // $students = StudentDetail::all();
        // dd($students);
        // return view('admin-panel.pages.add-attendence', compact('students', ));
        return response()->json([
            'students' => $students
        ]);
    }
    public function storeAttendance(Request $request)
    {
        Log::info('Marking attendance', $request->all()); // Add this for debug
        // Check if attendance already exists for this student and date
        $existing = Attendance::where('student_name', $request->student_name)
            ->where('rollNo', $request->rollNo)
            ->where('date', $request->date)
            ->first();

        if ($existing) {
            // Update status if record exists
            $existing->update([
                'status' => $request->status
            ]);

            return response()->json(['message' => 'Attendance updated to ' . $request->status]);
        } else {
            // Create new attendance if no record exists
            Attendance::create([
                'student_name' => $request->student_name,
                'rollNo' => $request->rollNo,
                'date' => $request->date,
                'status' => $request->status,
            ]);

            return response()->json(['message' => 'Attendance marked as ' . $request->status]);
        }
    }
}

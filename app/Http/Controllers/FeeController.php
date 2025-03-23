<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fee;

class FeeController extends Controller
{
    // 📝 View Fees Page
    public function index()
    {
        $fees = Fee::all();
        return view('student-dashboard.fees', compact('fees'));
    }

    // 📝 Add New Fee Record
    public function create()
    {
        return view('student-dashboard.add-fee');
    }

    // 📝 Store Fee Record
    public function store(Request $request)
    {
        $request->validate([
            'student_name' => 'required',
            'student_id' => 'required|unique:fees,student_id',
            'total_fees' => 'required|numeric',
            'paid_fees' => 'required|numeric',
            'due_fees' => 'required|numeric',
            'due_date' => 'required|date',
        ]);

        Fee::create($request->all());

        return redirect()->route('fees.index')->with('success', 'Fee record added successfully!');
    }
}


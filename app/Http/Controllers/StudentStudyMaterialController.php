<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudyMaterial;

class StudentStudyMaterialController extends Controller
{
    // 📝 Show Study Materials for Students
    public function index()
    {
        $materials = StudyMaterial::all(); // Fetch all study materials
        // dd($materials);
        return view('student-dashboard.study-materials', compact('materials'));
    }
}

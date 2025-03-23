<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudyMaterial;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use PDF;

class StudyMaterialController extends Controller
{
    /**
     * Display a listing of study materials.
     */
    public function index()
    {
        $materials = StudyMaterial::all();
        return view('admin-panel.pages.studyMaterial', compact('materials'));
    }

    /**
     * Store a newly created study material.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'material_type' => 'required|string',
            'class_name' => 'required|string|max:100',
            'subject_name' => 'required|string|max:100',
            'file' => 'required|file|mimes:pdf,doc,docx,xlsx,csv,png,jpg,jpeg|max:5048',
            'due_date' => 'nullable|date',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalFileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('study-materials', $originalFileName, 'public');

            // Convert to PDF if not already PDF
            $convertedPath = $this->convertToPDF($file, $originalFileName);
        }

        StudyMaterial::create([
            'title' => $request->title,
            'material_type' => $request->material_type,
            'class_name' => $request->class_name,
            'subject_name' => $request->subject_name,
            'due_date' => $request->material_type !== 'Notes' && $request->material_type !== 'Other' ? $request->due_date : null,
            'file_name' => $originalFileName,
            'file_path' => $convertedPath ?? $filePath,
        ]);

        return redirect()->route('studyMaterial.index')->with('success', 'Study Material Uploaded Successfully!');
    }

    /**
     * Convert any file type to PDF
     */
    private function convertToPDF($file, $originalFileName)
    {
        $ext = $file->getClientOriginalExtension();
        $pdfFileName = pathinfo($originalFileName, PATHINFO_FILENAME) . '.pdf';
        $pdfPath = 'study-materials/' . $pdfFileName;
        $fullPath = storage_path('app/public/' . $pdfPath);

        if ($ext === 'pdf') {
            return 'storage/' . $pdfPath;
        }

        $mpdf = new Mpdf();

        if (in_array($ext, ['png', 'jpg', 'jpeg'])) {
            $imageData = file_get_contents($file->getRealPath());
            $base64Image = base64_encode($imageData);
            $mpdf->WriteHTML('<img src="data:image/' . $ext . ';base64,' . $base64Image . '"/>');
        } else {
            $content = file_get_contents($file->getRealPath());
            $mpdf->WriteHTML('<pre>' . htmlentities($content) . '</pre>');
        }

        $mpdf->Output($fullPath, 'F'); 

        return 'storage/' . $pdfPath;
    }

    /**
     * Download study material
     */
    public function download($id)
    {
        $material = StudyMaterial::findOrFail($id);
    
        // Public folder me se file ka path get karein
        $filePath = public_path('storage/study-materials/' . $material->file_name);
    
        if (file_exists($filePath)) {
            return response()->download($filePath);
        }
    
        return redirect()->back()->with('error', 'File not found!');
    }
    

    /**
     * Delete the study material.
     */
    public function destroy($id)
    {
        $material = StudyMaterial::findOrFail($id);
    
        // File path ko storage se properly delete karna
        $filePath = 'public/' . $material->file_path;
    
        if ($material->file_path && Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    
        // Database se delete karna
        $material->delete();
    
        return redirect()->route('studyMaterial.index')->with('success', 'Study Material Deleted Successfully!');
    }
    
    
}

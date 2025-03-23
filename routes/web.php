<?php

use App\Http\Controllers\ClassStudentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SchoolDetailsController;
use App\Http\Controllers\StudentDetailController;
use App\Http\Controllers\SubjectWithClassController;
use App\Http\Controllers\TeacherDetailController;
use App\Http\Controllers\TeachersNameController;
use App\Http\Controllers\StudyMaterialController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\StudentStudyMaterialController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserRegisterConroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// admin panel route start


Route::get('/admin',function(){
    return view('admin-panel.dashboard');
})->name('admin-dashboard');

Route::get('admin/registration',[UserRegisterConroller::class,'showUsers'])->name('registeration');
Route::post('admin/registration',[UserRegisterConroller::class,'store'])->name('storeUser');

// roles page route start
Route::get('admin/roles',[RoleController::class, 'show'])->name('roles');
Route::post('admin/roles/submit',[RoleController::class, 'roleSubmit'])->name('roleSubmit');
Route::delete('admin/roles/{uuid}',[RoleController::class,'destroy'])->name('destroy');
Route::get('admin/edit', [RoleController::class, 'edit'])->name('roleEdit');
Route::put('admin/roles/update', [RoleController::class, 'update'])->name('roleUpdate');

// roles page route end



// student detail page route start

Route::get('admin/student-details',[StudentDetailController::class,'show'])->name('student-details');
Route::post('admin/student-details/submit',[StudentDetailController::class,'studentDetailSubmit'])->name('studentDetailSubmit');
Route::delete('admin/student-details/{uuid}',[StudentDetailController::class,'destroy'])->name('studentDetailDelete');
Route::get('admin/studentdetailedit',[StudentDetailController::class,'edit'])->name('studentDetailEdit');
Route::put('admin/student-details/update',[StudentDetailController::class,'update'])->name('studentDetailUpdate');

// student detail page route end

// teacher detail page route start

Route::get('admin/teacher-details',[TeacherDetailController::class,'show'])->name('teacher-details');
Route::post('admin/teacher-detail/submit',[TeacherDetailController::class,'teacherDetailSubmit'])->name('teacherDetailSubmit');
Route::delete('admin/teacher-detail/{uuid}',[TeacherDetailController::class,'destroy'])->name('teacherDetailDelete');
Route::get('admin/teacherdetailedit',[TeacherDetailController::class,'edit'])->name('teacherDetailEdit');
Route::put('admin/teacher-details/update',[TeacherDetailController::class,'update'])->name('teacherDetailUpdate');
// teacher detail page route end

// users detail page route start

Route::delete('admin/user-detail/{uuid}',[UserRegisterConroller::class,'delete'])->name('userDetailsDelete');
Route::put('admin/user-detail/update',[UserRegisterConroller::class,'update'])->name('userDetailsUpdate');
// users detail page route end

// school detail page route start

Route::get('admin/school-details',[SchoolDetailsController::class,'show'])->name('school-details');
Route::post('admin/school-details/submit',[SchoolDetailsController::class,'store'])->name('schoolDetailSubmit');
Route::delete('admin/school-details/{uuid}',[SchoolDetailsController::class,'destroy'])->name('schoolDetailDelete');
Route::put('admin/school-details/update',[SchoolDetailsController::class,'update'])->name('schoolDetailUpdate');
// school detail page route end

// teacher with school name page route start

Route::get('admin/teachers',[TeachersNameController::class,'index'])->name('teachers');
Route::post('admin/teachers/submit',[TeachersNameController::class,'store'])->name('teacherWithSchoolNameSubmit');
Route::delete('admin/teachers/{uuid}',[TeachersNameController::class,'destroy'])->name('teacherWithSchoolNameDelete');
Route::put('admin/teachers/update',[TeachersNameController::class,'update'])->name('teacherWithSchoolNameUpdate');

// teacher with school name page route end

// class page route start

Route::get('admin-panel/class',[ClassStudentController::class,'show'])->name('class');
Route::post('admin/class',[ClassStudentController::class,'store'])->name('studentClassSubmit');
Route::delete('admin/class/{uuid}',[ClassStudentController::class,'destroy'])->name('classNameDelete');
Route::put('admin/class/update',[ClassStudentController::class,'update'])->name('classNameUpdate');

// class page route end
// subject with class page route start

Route::get('admin/subjects',[SubjectWithClassController::class,'index'])->name('subjects');
Route::post('admin/subjects/submit',[SubjectWithClassController::class,'store'])->name('subjectWithClassSubmit');
Route::delete('admin/subjects/{uuid}',[SubjectWithClassController::class,'destroy'])->name('subjectWithClassDelete');
Route::put('admin/subjects/update',[SubjectWithClassController::class,'update'])->name('subjectWithClassUpdate');


// subject with class page route end

// study material route start

// Route::get('admin/study-material',function(){
//     return view('admin-panel.pages.studyMaterial');
// })->name('studyMaterials');




Route::get('/study-materials', [StudyMaterialController::class, 'index'])->name('studyMaterial.index');
Route::get('/study-materials/create', [StudyMaterialController::class, 'create'])->name('studyMaterial.create');
Route::post('/study-materials', [StudyMaterialController::class, 'store'])->name('studyMaterial.store');
Route::get('/study-materials/download/{id}', [StudyMaterialController::class, 'download'])->name('studyMaterial.download');
Route::delete('/study-materials/{id}', [StudyMaterialController::class, 'destroy'])->name('studyMaterial.destroy');






// study material route end

// student dashboard route start

// study material routes start
Route::get('/student-dashboard/study-materials', [StudentController::class, 'studyMaterials'])->name('study.materials');
Route::get('/student-dashboard/create-notes', [StudentController::class, 'createNotes'])->name('notes.create');
Route::post('/student-dashboard/save-notes', [StudentController::class, 'saveNotes'])->name('notes.save');
Route::get('/student-dashboard/my-notes', [StudentController::class, 'myNotes'])->name('notes.myNotes');
// Route::get('/student/study-materials', [StudentController::class, 'studentStudyMaterials'])->name('student.studyMaterial');


Route::get('/student/study-materials', [StudentStudyMaterialController::class, 'index'])->name('student.studyMaterials');


// study material route end
// view notes route


Route::delete('student-dashboard/notes/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');


// start preparing card route start



Route::get('/student-dashboard/quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::get('/student-dashboard/quiz/create', [QuizController::class, 'create'])->name('quiz.create');
Route::post('/student-dashboard/quiz', [QuizController::class, 'store'])->name('quiz.store');
Route::post('/student-dashboard/quiz/evaluate', [QuizController::class, 'evaluate'])->name('quiz.evaluate');
Route::delete('/student-dashboard/quiz/{id}', [QuizController::class, 'destroy'])->name('quiz.destroy');


// start preparing card route end

// view attendence page route start


Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.view');
Route::get('/attendance/add', [AttendanceController::class, 'create'])->name('attendance.create');
Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');


// view attendence page route end

// view result page route start


Route::get('/results', [ResultController::class, 'index'])->name('results.index');
Route::post('/results', [ResultController::class, 'store'])->name('results.store');
Route::delete('/results/{id}', [ResultController::class, 'destroy'])->name('results.destroy');


// view result page route end

// view fees page route start



Route::get('/fees', [FeeController::class, 'index'])->name('fees.index');
Route::get('/fees/create', [FeeController::class, 'create'])->name('fees.create');
Route::post('/fees/store', [FeeController::class, 'store'])->name('fees.store');


// view fees page route end




// student dashboard route end



// admin panel route end
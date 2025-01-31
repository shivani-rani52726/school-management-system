<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SchoolDetailsController;
use App\Http\Controllers\StudentDetailController;
use App\Http\Controllers\TeacherDetailController;
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
// Route::get('/admin/registration',function(){
//     return view('admin-panel.pages.stu_registration');
// })->name('registeration');

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




// admin panel route end
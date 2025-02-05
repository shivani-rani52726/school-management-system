@extends('admin-panel.index')
@section('admin-panel')
    <div class="bg-gray-100 py-10 px-5">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-full">
            <div class="text-center mb-5">
                <h1 class="text-3xl font-semibold text-center mb-6">Teacher Details Management</h1>
            </div>
            @if (session('success'))
                <div class="msg-hide text-left bg-green-200 my-3 p-2">
                    {{ session('success') }}
                </div>
            @endif


            <div class="bg-gray-100 px-4 py-3 rounded-t shadow-md">

                <div class="bg-white p-6 rounded shadow-lg relative">
                    <form method="POST" action="{{ route('teacherDetailUpdate') }}">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="teacherId" value="{{ $editTeacherDetail->uuid }}">
                        <a href="{{ route('teacher-details') }}" type="button"
                        class="absolute top-0 right-0 -mt-2 -mr-3 text-red px-4 py-2 rounded hover:text-red-500 text-xl font-bold">X</a>
                        <h2 class="text-xl font-semibold mb-4">Edit Teacher Detail</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="teacherName" class="block text-sm font-medium text-gray-700 mb-1">Teacher
                                    Name</label>
                                <input type="text" id="teacherName" value="{{ $editTeacherDetail->teacher_name }}"
                                    name="teacherName" class="p-2 border rounded w-full" required>
                            </div>
                            <div>
                                <label for="teacherSchoolName"
                                    class="block text-sm font-medium text-gray-700 mb-1">Teacher's School Name</label>
                                <input type="text" id="teacherSchoolName"
                                    value="{{ $editTeacherDetail->teacher_school_name }}" name="teacherSchoolName"
                                    class="p-2 border rounded w-full" required>
                            </div>
                            <div>
                                <label for="teacherClass" class="block text-sm font-medium text-gray-700 mb-1">Teacher's
                                    Class</label>
                                <input type="text" id="teacherClass" value="{{ $editTeacherDetail->teacher_class }}"
                                    name="teacherClass" class="p-2 border rounded w-full" required>
                            </div>
                            <div>
                                <label for="teacherSubject" class="block text-sm font-medium text-gray-700 mb-1">Teacher's
                                    Subject</label>
                                <input type="text" id="teacherSubject" value="{{ $editTeacherDetail->teacher_subject }}"
                                    name="teacherSubject" class="p-2 border rounded w-full" required>
                            </div>
                            <div>
                                <label for="aadhaarNo" class="block text-sm font-medium text-gray-700 mb-1">Aadhaar
                                    Number</label>
                                <input type="number" id="aadhaarNo" value="{{ $editTeacherDetail->aadhar_no }}"
                                    name="aadhaarNo" class="p-2 border rounded w-full" required>
                            </div>
                            <div>
                                <label for="contactNo" class="block text-sm font-medium text-gray-700 mb-1">Contact
                                    Number</label>
                                <input type="text" id="contactNo" value="{{ $editTeacherDetail->contact_no }}"
                                    name="contactNo" maxlength="10" minlength="10" class="p-2 border rounded w-full"
                                    pattern="\d{10}" title="Please enter exactly 10 digits" required>
                            </div>
                            <div class="md:col-span-2">
                                <label for="teacherAddress"
                                    class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                <textarea id="teacherAddress" name="teacherAddress" class="p-2 border rounded w-full" rows="3" required>{{ $editTeacherDetail->address }}</textarea>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                Update
                            </button>
                            <a href="{{ route('teacher-details') }}" type="button"
                                class="bg-red-500 text-white px-4 py-2 rounded-md mr-2">cancel</a>
                        </div>
                    </form>




                </div>
            </div>



        </div>
    </div>
@endsection

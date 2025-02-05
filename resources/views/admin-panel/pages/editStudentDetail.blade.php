@extends('admin-panel.index')
@section('admin-panel')
    <div class="bg-gray-100 py-10 px-5">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-full">
            <div class="text-center mb-5">
                <h1 class="text-3xl font-semibold text-center mb-6">Student Details Management</h1>
            </div>
            @if (session('success'))
                <div class="msg-hide text-left bg-green-200 my-3 p-2">
                    {{ session('success') }}
                </div>
            @endif



            {{-- edit form model  --}}
            <div class="bg-gray-100 px-4 py-3 rounded-t shadow-md">
                <div class="bg-white p-6 rounded shadow-lg relative">
                    <form method="POST" action="{{ route('studentDetailUpdate') }}">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="studentId" value="{{ $editStudentDetail->uuid }}">
                        <a href="{{ route('student-details') }}" type="button"
                        class="absolute top-0 right-0 -mt-2 -mr-3 text-red px-4 py-2 rounded hover:text-red-500 text-xl font-bold">X</a>
                        <h2 class="text-xl font-semibold mb-4">Edit Student Detail</h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="studentName" class="block text-sm font-medium text-gray-700">Student
                                    Name</label>
                                <input type="text" id="studentName" name="studentName"
                                    value="{{ $editStudentDetail->stu_name }}" class="p-2 border rounded w-full" required>
                            </div>
                            <div>
                                <label for="roll_No" class="block text-sm font-medium text-gray-700">Roll Number</label>
                                <input type="number" id="roll_No" name="roll_No" value="{{ $editStudentDetail->rollNo }}"
                                    class="p-2 border rounded w-full" required>
                            </div>
                            <div>
                                <label for="stuClass" class="block text-sm font-medium text-gray-700">Class</label>
                                <input type="text" id="stuClass" name="stuClass" value="{{ $editStudentDetail->class }}"
                                    class="p-2 border rounded w-full" required>
                            </div>
                            <div>
                                <label for="fatherName" class="block text-sm font-medium text-gray-700">Father's
                                    Name</label>
                                <input type="text" id="fatherName" name="fatherName"
                                    value="{{ $editStudentDetail->father_name }}" class="p-2 border rounded w-full"
                                    required>
                            </div>
                            <div>
                                <label for="motherName" class="block text-sm font-medium text-gray-700">Mother's
                                    Name</label>
                                <input type="text" id="motherName" name="motherName"
                                    value="{{ $editStudentDetail->mother_name }}" class="p-2 border rounded w-full"
                                    required>
                            </div>
                            <div>
                                <label for="aadhaarNo" class="block text-sm font-medium text-gray-700">Aadhaar
                                    Number</label>
                                <input type="number" id="aadhaarNo" name="aadhaarNo"
                                    value="{{ $editStudentDetail->aadhar_number }}" class="p-2 border rounded w-full"
                                    required>
                            </div>
                            <div class="col-span-2">
                                <label for="stu_address" class="block text-sm font-medium text-gray-700">Address</label>

                                <textarea id="stu_address" name="stu_address" class="p-2 border rounded w-full" rows="3" required>{{ $editStudentDetail->address }}</textarea>
                            </div>
                            <div class="col-span-2">
                                <label for="contactNo" class="block text-sm font-medium text-gray-700">Contact
                                    Number</label>
                                <input type="text" id="contactNo" name="contactNo"
                                    value="{{ $editStudentDetail->contact_number }}" maxlength="10" minlength="10"
                                    class="p-2 border rounded w-full" pattern="\d{10}"
                                    title="Please enter exactly 10 digits" required>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <a href="{{ route('student-details') }}" type="button"
                                class="bg-red-500 text-white px-4 py-2 rounded-md mr-2">cancel</a>
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded  ml-2">
                                update
                            </button>
                        </div>
                    </form>
                </div>
            </div>






        </div>
    </div>
@endsection

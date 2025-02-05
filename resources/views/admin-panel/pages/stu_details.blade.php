@extends('admin-panel.index')
@section('admin-panel')
    <div class="bg-gray-100 py-10 px-5">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-full">
            <div class="container mx-auto relative">
                <!-- Header -->
                <div class="text-center mb-5">
                    <h1 class="text-3xl font-semibold text-center mb-6">Student Details Management</h1>
                </div>

                @if (session('success'))
                    <div class="msg-hide text-left bg-green-200 my-3 p-2">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Add Student Button -->
                <div class="text-center mb-5">
                    <button id="addStudentBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Add Student Details
                    </button>
                </div>

                <!-- Student Details Table -->
                <div id="studentTable" class="mt-5">
                    <h2 class="text-xl font-bold text-gray-700 mb-3">Student Details</h2>
                    <table class="table-auto w-full bg-white shadow-md rounded text-center">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Roll No</th>
                                <th class="px-4 py-2">Class</th>
                                <th class="px-4 py-2">Father's Name</th>
                                <th class="px-4 py-2">Mother's Name</th>
                                <th class="px-4 py-2">Aadhaar No</th>
                                <th class="px-4 py-2">Address</th>
                                <th class="px-4 py-2">Contact No</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="studentTableBody">
                            @if (isset($allStudentRecord))
                                @foreach ($allStudentRecord as $studentRecord)
                                    <tr>
                                        <td class="text-center py-2">{{ $studentRecord->stu_name }}</td>
                                        <td class="text-center py-2">{{ $studentRecord->rollNo }}</td>
                                        <td class="text-center py-2">{{ $studentRecord->class }}</td>
                                        <td class="text-center py-2">{{ $studentRecord->father_name }}</td>
                                        <td class="text-center py-2">{{ $studentRecord->mother_name }}</td>
                                        <td class="text-center py-2">{{ $studentRecord->aadhar_number }}</td>
                                        <td class="text-center py-2">{{ $studentRecord->address }}</td>
                                        <td class="text-center py-2">{{ $studentRecord->contact_number }}</td>
                                        <td class="flex justify-center items-center text-center py-2">
                                            <form method="POST" action="{{ route('studentDetailEdit') }}">
                                                @method('GET')
                                                @csrf
                                                <input type="hidden" name="studentId" value="{{ $studentRecord->uuid }}">
                                                <button type="submit"
                                                    class="bg-green-500 text-white px-4 py-2 rounded-md m-1"
                                                    id="showEditModel">Edit</button>
                                            </form>
                                            <form method="POST"
                                                action="{{ route('studentDetailDelete', $studentRecord->uuid) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                    class="bg-red-500 text-white px-4 py-2 rounded-md m-1"
                                                    id="showDeleteModel">Delete</button>
                                            </form>
                                            <button type="buttoon" class="bg-blue-500 text-white px-4 py-2 rounded-md m-1"
                                                onclick="openModal(this)"
                                                data-student-name="{{ $studentRecord->stu_name }}"
                                                data-student-rollNo="{{ $studentRecord->rollNo }}"
                                                data-student-class="{{ $studentRecord->class }}"
                                                data-student-fatherName="{{ $studentRecord->father_name }}"
                                                data-student-motherName="{{ $studentRecord->mother_name }}"
                                                data-student-adharNumber="{{ $studentRecord->aadhar_number }}"
                                                data-student-address="{{ $studentRecord->address }}"
                                                data-student-contactNumber="{{ $studentRecord->contact_number }}">View</button>

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- View Modal -->
            <div id="viewModal"
                class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden">
                <div class="bg-white rounded shadow-lg w-full max-w-lg p-5 relative">
                    <button id="closeViewModal" class="absolute top-0 right-0 -mt-2 -mr-3 text-red px-4 py-2 rounded hover:text-red-500 text-xl font-bold"
                    onclick="closeModel()">X</button>
                    <h2 class="text-xl font-bold text-gray-700 mb-3">View Student Details</h2>
                    <div id="viewContent" class="text-left"></div>

                    <div class="text-center mt-4">
                        <button id="closeViewModal" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                            onclick="closeModel()">Close</button>
                    </div>
                </div>

            </div>

            <!-- Modals -->
            <!-- Form Modal -->
            <div id="formModal"
                class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden">
                <div class="bg-white rounded shadow-lg w-full max-w-lg p-5 relative">

                    <!-- Close Button (Top Right Corner of Form) -->
                    <button id="closeForm"
                        class="absolute top-0 right-0 p-0 -mt-2  text-gray-700 text-3xl font-bold hover:text-red-600">
                        &times;
                    </button>
                    <h2 class="text-xl font-bold text-gray-700 mb-3">Add Student Details</h2>
                    <form id="studentForm" method="POST" action="{{ route('studentDetailSubmit') }}">
                        @csrf
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="studentName" class="block text-sm font-medium text-gray-700">Student
                                    Name</label>
                                <input type="text" id="studentName" name="studentName" class="p-2 border rounded w-full"
                                    placeholder="Enter student name" required>
                            </div>
                            <div>
                                <label for="roll_No" class="block text-sm font-medium text-gray-700">Roll Number</label>
                                <input type="number" id="roll_No" name="roll_No" class="p-2 border rounded w-full"
                                    placeholder="Enter roll number" required>
                            </div>
                            <div>
                                <label for="stuClass" class="block text-sm font-medium text-gray-700">Class</label>
                                <input type="text" id="stuClass" name="stuClass" class="p-2 border rounded w-full"
                                    placeholder="Enter class" required>
                            </div>
                            <div>
                                <label for="fatherName" class="block text-sm font-medium text-gray-700">Father's
                                    Name</label>
                                <input type="text" id="fatherName" name="fatherName"
                                    class="p-2 border rounded w-full" placeholder="Enter father's name" required>
                            </div>
                            <div>
                                <label for="motherName" class="block text-sm font-medium text-gray-700">Mother's
                                    Name</label>
                                <input type="text" id="motherName" name="motherName"
                                    class="p-2 border rounded w-full" placeholder="Enter mother's name" required>
                            </div>
                            <div>
                                <label for="aadhaarNo" class="block text-sm font-medium text-gray-700">Aadhaar
                                    Number</label>
                                <input type="number" id="aadhaarNo" name="aadhaarNo" class="p-2 border rounded w-full"
                                    placeholder="Enter Aadhaar number" required>
                            </div>
                            <div class="col-span-2">
                                <label for="stu_address" class="block text-sm font-medium text-gray-700">Address</label>
                                <textarea id="stu_address" name="stu_address" class="p-2 border rounded w-full" placeholder="Enter address"
                                    rows="3" required></textarea>
                            </div>
                            <div class="col-span-2">
                                <label for="contactNo" class="block text-sm font-medium text-gray-700">Contact
                                    Number</label>
                                <input type="text" id="contactNo" name="contactNo" maxlength="10" minlength="10"
                                    class="p-2 border rounded w-full" placeholder="Enter contact number" pattern="\d{10}"
                                    title="Please enter exactly 10 digits" required>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                Submit
                            </button>
                            <button type="button" id="closeModal"
                                class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 ml-2">
                                Cancel
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        const addStudentBtn = document.getElementById('addStudentBtn');
        const formModal = document.getElementById('formModal');
        const closeModal = document.getElementById('closeModal');
        const studentForm = document.getElementById('studentForm');

        let editRow = null; // Track the row to edit

        // Show Form Modal for adding new student
        addStudentBtn.addEventListener('click', () => {
            formModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            // Clear form for adding new student
            studentForm.reset();
            editRow = null; // Reset the edit row
        });

        // Close the Form Modal
        closeModal.addEventListener('click', () => {
            formModal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });



        function openModal(s) {
            document.getElementById('viewModal').classList.remove('hidden');
            const viewStudentName = s.getAttribute('data-student-name');
            const viewRollNo = s.getAttribute('data-student-rollNo');
            const viewClass = s.getAttribute('data-student-class');
            const viewFatherName = s.getAttribute('data-student-fatherName');
            const viewMotherName = s.getAttribute('data-student-motherName');
            const viewAdharNumber = s.getAttribute('data-student-adharNumber');
            const viewAddress = s.getAttribute('data-student-address');
            const viewContactNumber = s.getAttribute('data-student-contactNumber');
            document.querySelector('#viewContent').innerHTML = `
             <div class="flex justify-between">
                <div><strong>Student Name :</strong></div>
                <div>${viewStudentName}</div>
            </div>
             <div class="flex justify-between">
                <div><strong>Roll No :</strong></div>
                <div>${viewRollNo}</div>
            </div>
             <div class="flex justify-between">
                <div><strong>Class :</strong></div>
                <div>${viewClass}</div>
            </div>
             <div class="flex justify-between">
                <div><strong>Father's Name :</strong></div>
                <div>${viewFatherName}</div>
            </div>
             <div class="flex justify-between">
                <div><strong>Mother's Name :</strong></div>
                <div>${viewMotherName}</div>
            </div>
             <div class="flex justify-between">
                <div><strong>Aadhaar Number :</strong></div>
                <div>${viewAdharNumber}</div>
            </div>
             <div class="flex justify-between">
                <div><strong>Address :</strong></div>
                <div>${viewAddress}</div>
            </div>
             <div class="flex justify-between">
                <div><strong>Contact No :</strong></div>
                <div>${viewContactNumber}</div>
            </div>
           
            `;
        }

        function closeModel() {
            document.getElementById('viewModal').classList.add('hidden');
        }

        // Close the form modal (X button)
        document.getElementById('closeForm').addEventListener('click', function() {
            document.getElementById('formModal').classList.add('hidden');
        });
    </script>
@endsection

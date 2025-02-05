@extends('admin-panel.index')

@section('admin-panel')
    <div class="bg-gray-100 py-10 px-5">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-full">
            <div class="container mx-auto relative">
                <!-- Header -->
                <div class="text-center mb-5">
                    <h1 class="text-3xl font-semibold text-center mb-6">Teacher Details Management</h1>
                </div>

                @if (session('success'))
                    <div class="msg-hide text-left bg-green-200 my-3 p-2">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Add Teacher Button -->
                <div class="text-center mb-5">
                    <button id="addTeacherBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Add Teacher Details
                    </button>
                </div>

                <!-- Teacher Details Table -->
                <div id="teacherTable" class="mt-5">
                    <h2 class="text-xl font-bold text-gray-700 mb-3">Teacher Details</h2>
                    <table class="table-auto w-full bg-white shadow-md rounded text-center">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="px-4 py-2">Teacher Name</th>
                                <th class="px-4 py-2">Teacher's School Name</th>
                                <th class="px-4 py-2">Teacher's Class</th>
                                <th class="px-4 py-2">Teacher's Subject</th>
                                <th class="px-4 py-2">Aadhaar No</th>
                                <th class="px-4 py-2">Contact No</th>
                                <th class="px-4 py-2">Address</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="teacherTableBody">

                            @if (isset($allTeacherRecord))
                                @foreach ($allTeacherRecord as $teacherRecord)
                                    <tr>
                                        <td class="text-center py-2">{{ $teacherRecord->teacher_name }}</td>
                                        <td class="text-center py-2">{{ $teacherRecord->teacher_school_name }}</td>
                                        <td class="text-center py-2">{{ $teacherRecord->teacher_class }}</td>
                                        <td class="text-center py-2">{{ $teacherRecord->teacher_subject }}</td>
                                        <td class="text-center py-2">{{ $teacherRecord->aadhar_no }}</td>
                                        <td class="text-center py-2">{{ $teacherRecord->contact_no }}</td>
                                        <td class="text-center py-2">{{ $teacherRecord->address }}</td>
                                        <td class="flex justify-center items-center text-center py-2">
                                            <form method="POST" action="{{ route('teacherDetailEdit') }}">
                                                @method('GET')
                                                @csrf
                                                <input type="hidden" name="teacherId" value="{{ $teacherRecord->uuid }}">
                                                <button type="submit"
                                                    class="bg-green-500 text-white px-4 py-2 rounded-md m-1"
                                                    id="showEditModel">Edit</button>
                                            </form>
                                            <form method="POST"
                                                action="{{ route('teacherDetailDelete', $teacherRecord->uuid) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                    class="bg-red-500 text-white px-4 py-2 rounded-md m-1"
                                                    id="showDeleteModel">Delete</button>
                                            </form>
                                            <button type="buttoon" class="bg-blue-500 text-white px-4 py-2 rounded-md m-1"
                                                id="showViewModel" onclick="openModal(this)"
                                                data-teacher-name="{{ $teacherRecord->teacher_name }}"
                                                data-teacher-SchoolName="{{ $teacherRecord->teacher_school_name }}"
                                                data-teacher-class="{{ $teacherRecord->teacher_class }}"
                                                data-teacher-subject="{{ $teacherRecord->teacher_subject }}"
                                                data-teacher-aadharNo="{{ $teacherRecord->aadhar_no }}"
                                                data-teacher-contactNo="{{ $teacherRecord->contact_no }}"
                                                data-teacher-address="{{ $teacherRecord->address }}">View</button>

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
                    <button  class="absolute top-0 right-0 -mt-2 -mr-3 text-red px-4 py-2 rounded hover:text-red-500 text-xl font-bold"
                            onclick="closeModel()">X</button>
                    <h2 class="text-xl font-bold text-gray-700 mb-3">View Teacher Details</h2>
                    <div id="viewContent" class="text-left"></div>

                    <div class="text-center mt-4">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                            onclick="closeModel()">Close</button>
                    </div>
                </div>

            </div>

            <!-- Modals -->
            <!-- Form Modal -->
            <div id="formModal"
                class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden">
                <div class="bg-white rounded shadow-lg w-full max-w-lg p-5 relative">
                    <button type="button" id="closeModalSym"
                        class="absolute top-0 right-0 -mt-2 -mr-3 text-red px-4 py-2 rounded hover:text-red-500 text-xl font-bold">
                        X
                    </button>
                    <h2 class="text-xl font-bold text-gray-700 mb-3">Add Teacher Details</h2>
                    <form id="teacherForm" method="POST" action="{{ route('teacherDetailSubmit') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="teacherName" class="block text-sm font-medium text-gray-700 mb-1">Teacher
                                    Name</label>
                                <input type="text" id="teacherName" name="teacherName" class="p-2 border rounded w-full"
                                    placeholder="Teacher Name" required>
                            </div>
                            <div>
                                <label for="teacherSchoolName"
                                    class="block text-sm font-medium text-gray-700 mb-1">Teacher's School Name</label>
                                <input type="text" id="teacherSchoolName" name="teacherSchoolName"
                                    class="p-2 border rounded w-full" placeholder="Teacher School Name" required>
                            </div>
                            <div>
                                <label for="teacherClass" class="block text-sm font-medium text-gray-700 mb-1">Teacher's
                                    Class</label>
                                <input type="text" id="teacherClass" name="teacherClass"
                                    class="p-2 border rounded w-full" placeholder="Teacher Class" required>
                            </div>
                            <div>
                                <label for="teacherSubject" class="block text-sm font-medium text-gray-700 mb-1">Teacher's
                                    Subject</label>
                                <input type="text" id="teacherSubject" name="teacherSubject"
                                    class="p-2 border rounded w-full" placeholder="Teacher Subject" required>
                            </div>
                            <div>
                                <label for="aadhaarNo" class="block text-sm font-medium text-gray-700 mb-1">Aadhaar
                                    Number</label>
                                <input type="number" id="aadhaarNo" name="aadhaarNo" class="p-2 border rounded w-full"
                                    placeholder="Aadhaar Number" required>
                            </div>
                            <div>
                                <label for="contactNo" class="block text-sm font-medium text-gray-700 mb-1">Contact
                                    Number</label>
                                <input type="text" id="contactNo" name="contactNo" maxlength="10" minlength="10"
                                    class="p-2 border rounded w-full" placeholder="Contact Number" pattern="\d{10}"
                                    title="Please enter exactly 10 digits" required>
                            </div>
                            <div class="md:col-span-2">
                                <label for="teacherAddress"
                                    class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                <textarea id="teacherAddress" name="teacherAddress" class="p-2 border rounded w-full" placeholder="Address"
                                    rows="3" required></textarea>
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
        const addTeacherBtn = document.getElementById('addTeacherBtn');
        const formModal = document.getElementById('formModal');
        const closeModal = document.getElementById('closeModal');
        const teacherForm = document.getElementById('teacherForm');
        const showViewModel = document.getElementById('showViewModel');
        const viewModal = document.getElementById('viewModal');


        let editRow = null;

        addTeacherBtn.addEventListener('click', () => {
            formModal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            teacherForm.reset();
            editRow = null;
        });

        closeModal.addEventListener('click', () => {
            formModal.classList.add('hidden');
            document.body.classList.add('overflow-hidden');
        });
        closeModalSym.addEventListener('click', () => {
            formModal.classList.add('hidden');
            document.body.classList.add('overflow-hidden');
        });


        function openModal(s) {
            const viewTeacherName = s.getAttribute('data-teacher-name');
            const viewTeacherSchoolName = s.getAttribute('data-teacher-SchoolName');
            const viewTeacherClass = s.getAttribute('data-teacher-class');
            const viewTeacherSubject = s.getAttribute('data-teacher-subject');
            const viewTeacherAdharNo = s.getAttribute('data-teacher-aadharNo');
            const viewTeacherContactNo = s.getAttribute('data-teacher-contactNo');
            const viewTeacherAddress = s.getAttribute('data-teacher-address');
            document.querySelector('#viewContent').innerHTML = `
             <div class="flex justify-between">
                <div><strong>Teacher Name :</strong></div>
                <div>${viewTeacherName}</div>
            </div>
            <div class="flex justify-between">
                <div><strong>Teacher's School Name :</strong></div>
                <div>${viewTeacherSchoolName}</div>
            </div>
            <div class="flex justify-between">
                <div><strong>Teacher's Class :</strong></div>
                <div>${viewTeacherClass}</div>
            </div>
            <div class="flex justify-between">
                <div><strong>Teacher's Subject :</strong></div>
                <div>${viewTeacherSubject}</div>
            </div>
            <div class="flex justify-between">
                <div><strong>Aadhaar No :</strong></div>
                <div>${viewTeacherAdharNo}</div>
            </div>
            <div class="flex justify-between">
                <div><strong>Contact No :</strong></div>
                <div>${viewTeacherContactNo}</div>
            </div>
            <div class="flex justify-between">
                <div><strong>Address :</strong></div>
                <div>${viewTeacherAddress}</div>
            </div>
           
            `;
            document.getElementById('viewModal').classList.remove('hidden');
        }

        function closeModel() {
            document.getElementById('viewModal').classList.add('hidden');
        }
    </script>
@endsection

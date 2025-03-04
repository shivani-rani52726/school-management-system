@extends('admin-panel.index')
@section('admin-panel')
    <div class="bg-gray-100 py-10 px-5">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-full">
            <div class="container mx-auto relative">
                <!-- Header -->
                <div class="text-center mb-5">
                    <h1 class="text-3xl font-semibold text-center mb-6">Teachers With School Name</h1>
                </div>

                @if (session('success'))
                    <div class="msg-hide text-left bg-green-200 my-3 p-2">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Add Teachers Button -->
                <div class="text-right mb-4">
                    <button id="addTeacherBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Add Teachers
                    </button>
                </div>

                <!-- Table Section -->
                <div class="mt-5">
                    <h2 class="text-xl font-bold mb-4 text-gray-700">Teacher Details</h2>
                    <table id="teacherTable" class="table-auto w-full bg-white border rounded shadow text-center">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-2 border">Id</th>
                                <th class="p-2 border">School Name</th>
                                <th class="p-2 border">Teacher Name</th>
                                <th class="p-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{ $teacherWithSchoolName }} --}}
                            @if (isset($teacherWithSchoolName))
                                @foreach ($teacherWithSchoolName as $teacherSchoolName)
                                    <tr>
                                        <td class="text-center py-2">{{ $loop->iteration }}</td>
                                        <td class="text-center py-2">{{ $teacherSchoolName->schoolDetail->school_name }}
                                        </td>
                                        <td class="text-center py-2">{{ $teacherSchoolName->teacherDetail->teacher_name }}
                                        </td>
                                        <td class="flex justify-center items-center text-center py-2">

                                            <button type="button" class="bg-green-500 text-white px-4 py-2 rounded-md m-1"
                                                id="showEditModel" onclick="openEditModel(this)"
                                                data-edit-id="{{ $teacherSchoolName->uuid }}"
                                                data-edit-schoolName="{{ $teacherSchoolName->schoolDetail->school_name }}"
                                                data-edit-teacherName="{{ $teacherSchoolName->teacherDetail->teacher_name }}">Edit</button>

                                            <form method="POST" action="{{ route('teacherWithSchoolNameDelete', $teacherSchoolName->uuid ) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                    class="bg-red-500 text-white px-4 py-2 rounded-md m-1"
                                                    >Delete</button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- model for edit button --}}
            <div id="viewEditModal"
                class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden">
                <div class="bg-white rounded shadow-lg w-full max-w-lg p-5 relative">
                    <button
                        class="absolute top-0 right-0 -mt-2 -mr-3 text-red px-4 py-2 rounded hover:text-red-500 text-xl font-bold"
                        onclick="closeEditModel()">X</button>
                    <h2 class="text-xl font-bold text-gray-700 mb-3">Edit School Details</h2>
                    <div id="viewEditContent" class="text-left"></div>
                    <div class="text-right" style="margin-top:-40px">
                        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                            onclick="closeEditModel()">Close</button>
                    </div>
                </div>
            </div>

            <!-- Form Modal -->
            <div id="formModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white relative p-6 rounded shadow-lg w-full max-w-md">
                    <!-- Close Button (Top Right Corner of Form) -->
                    <button id="closeForm"
                        class="absolute top-0 right-0 p-0 -mt-2  text-gray-700 text-3xl font-bold hover:text-red-600">
                        &times;
                    </button>


                    <h2 class="text-xl font-bold mb-4">Add Teachers</h2>
                    <form id="teacherForm" method="POST" action="{{ route('teacherWithSchoolNameSubmit') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="schoolName" class="block text-gray-700">School Name</label>
                            {{-- {{ $schoolDetail }} --}}

                            @if (isset($schoolDetail))
                                <select name="schoolId"
                                    class="block mt-1 p-2 w-full shadow-md focus:ring-2 focus:ring-indigo-500 focus:outline-none rounded-md">
                                    <option value="" disabled selected>Select a School Name</option>
                                    @foreach ($schoolDetail as $schoolName)
                                        <option value="{{ $schoolName->uuid }}">{{ $schoolName->school_name }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>

                        <!-- Teacher Inputs -->
                        <div id="teacherInputs">
                            <div class="flex items-center gap-2 mb-2">
                                @if (isset($teacherDetail))
                                    <select name="teacherId"
                                        class="block mt-1 p-2 w-full shadow-md focus:ring-2 focus:ring-indigo-500 focus:outline-none rounded-md">
                                        <option value="" disabled selected>Select a Teacher Name</option>
                                        @foreach ($teacherDetail as $teacherName)
                                            <option value="{{ $teacherName->uuid }}">{{ $teacherName->teacher_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                                <button type="button"
                                    class="deleteInput bg-red-500 text-white px-2 py-1 rounded">✖</button>
                            </div>
                        </div>

                        <!-- Form Buttons -->
                        <div class="flex justify-end gap-2 mt-4">
                            <button type="button" id="closeModal"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                                Cancel
                            </button>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>




        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const formModal = document.getElementById('formModal');
            const addTeacherBtn = document.getElementById('addTeacherBtn');
            const closeModal = document.getElementById('closeModal');
            const addMoreBtn = document.getElementById('addMore');
            const teacherForm = document.getElementById('teacherForm');
            const teacherInputs = document.getElementById('teacherInputs');
            const teacherTable = document.getElementById('teacherTable').querySelector('tbody');

            let count = 0;

            // Open Modal
            addTeacherBtn.addEventListener('click', () => {
                formModal.classList.remove('hidden');
            });

            // Close Modal
            closeModal.addEventListener('click', () => {
                formModal.classList.add('hidden');
                teacherForm.reset();
                teacherInputs.innerHTML = `
                <div class="flex items-center gap-2 mb-2">
                    <input type="text" name="teacherName[]" class="w-full p-2 border rounded" placeholder="Enter Teacher Name" required>
                    <button type="button" class="deleteInput bg-red-500 text-white px-2 py-1 rounded">✖</button>
                </div>
            `;
            });

            // Close the form modal (X button)
            document.getElementById('closeForm').addEventListener('click', function() {
                document.getElementById('formModal').classList.add('hidden');
            });


        });

        function openEditModel(s) {
            document.getElementById('viewEditModal').classList.remove('hidden');
            const editId = s.getAttribute('data-edit-id');
            const editSchoolName = s.getAttribute('data-edit-schoolName');
            const editTeacherName = s.getAttribute('data-edit-teacherName');
            document.querySelector('#viewEditContent').innerHTML = `
             <form  method="POST" action="{{ route('teacherWithSchoolNameUpdate') }}">
                       @method('PUT')
                        @csrf
                            <input type="hidden" name="teacherWithSchoolId" value="${editId}">
                        <div class="mb-4">
                            <label for="schoolName" class="block text-gray-700">School Name</label>
                            {{-- {{ $schoolDetail }} --}}

                            @if (isset($schoolDetail))
                                <select name="schoolId"
                                    class="block mt-1 p-2 w-full shadow-md focus:ring-2 focus:ring-indigo-500 focus:outline-none rounded-md">
                                    <option value="" disabled>Select a School Name</option>
                                    @foreach ($schoolDetail as $schoolName)
                                        <option value="{{ $schoolName->uuid }}">{{ $schoolName->school_name }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>

                        <!-- Teacher Inputs -->
                        <div id="teacherInputs">
                            <label for="schoolName" class="block text-gray-700">Teacher Name</label>
                            <div class="flex items-center gap-2 mb-2">
                                @if (isset($teacherDetail))
                                    <select name="teacherId"
                                        class="block mt-1 p-2 w-full shadow-md focus:ring-2 focus:ring-indigo-500 focus:outline-none rounded-md">
                                        <option value="" disabled>Select a Teacher Name</option>
                                        @foreach ($teacherDetail as $teacherName)
                                            <option value="{{ $teacherName->uuid }}">{{ $teacherName->teacher_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif
                                <button type="button"
                                    class="deleteInput bg-red-500 text-white px-2 py-1 rounded">✖</button>
                            </div>
                        </div>

                        <!-- Form Buttons -->
                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                Update
                            </button>
                        </div>
                    </form>
                `;
        }

        function closeEditModel() {
            document.getElementById('viewEditModal').classList.add('hidden');
        }
    </script>
@endsection

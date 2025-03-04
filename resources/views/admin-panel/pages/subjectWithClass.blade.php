@extends('admin-panel.index')

@section('admin-panel')
    <!-- Main Container -->
    <div class="bg-gray-100 py-10 px-5">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-full">
            <div class="container mx-auto relative">
                <!-- Header -->
                <div class="text-center mb-5">
                    <h1 class="text-3xl font-semibold text-center mb-6">Subjects Management</h1>
                </div>

                @if (session('success'))
                    <div class="msg-hide text-left bg-green-200 my-3 p-2">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Add Subject Button -->
                <div class="text-right mb-4">
                    <button id="addSubjectBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add
                        Subject</button>
                </div>

                <!-- Subjects Table -->
                <div class="mt-5">
                    <h2 class="text-xl font-bold text-gray-700 mb-4">Subjects List</h2>
                    <table id="subjectTable" class="table-auto w-full bg-white border rounded shadow text-center">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-2 border">Id</th>
                                <th class="p-2 border">Class Name</th>
                                <th class="p-2 border">Subject Name</th>
                                <th class="p-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($subjectWithClass))
                                @foreach ($subjectWithClass as $class)
                                    <tr>
                                        <td class="text-center py-2">{{ $loop->iteration }}</td>
                                        <td class="text-center py-2">{{ $class->className->class }}</td>
                                        <td class="text-center py-2">{{ $class->subject_name }}</td>
                                        <td class="flex justify-center items-center text-center py-2">

                                            <button type="button" class="bg-green-500 text-white px-4 py-2 rounded-md m-1"
                                                id="showEditModel" onclick="openEditModel(this)"
                                                data-edit-uuid="{{ $class->uuid }}"
                                                data-edit-className="{{ $class->className->class }}"
                                                data-edit-subjectName="{{ $class->subject_name }}">Edit</button>

                                            <form method="POST"
                                                action="{{ route('subjectWithClassDelete', $class->uuid) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                    class="bg-red-500 text-white px-4 py-2 rounded-md m-1">Delete</button>
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

            <!-- Subject Form Modal -->
            <div id="formModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-6 rounded shadow-lg w-full max-w-md relative">

                    <!-- Close Button (X) -->
                    <button id="closeForm"
                        class="absolute top-2 right-2 text-gray-700 text-3xl font-bold hover:text-red-600">
                        &times;
                    </button>


                    <h2 class="text-xl font-bold mb-4">Add Subject</h2>
                    <form id="subjectForm" method="POST" action="{{ route('subjectWithClassSubmit') }}">
                        @csrf
                        <!-- Select Class -->
                        <div class="mb-4">
                            <label for="className" class="block text-gray-700">Select Class</label>
                            {{-- {{ $className }} --}}

                            @if (isset($className))
                                <select name="classId"
                                    class="block mt-1 p-2 w-full shadow-md focus:ring-2 focus:ring-indigo-500 focus:outline-none rounded-md">
                                    <option value="" disabled selected>Select a Class Name</option>
                                    @foreach ($className as $classStudent)
                                        <option value="{{ $classStudent->uuid }}">{{ $classStudent->class }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>


                        <!-- Dynamic Subject Fields -->
                        <div id="subjectFields">
                            <div class="mb-4 flex items-center">
                                <input type="text" name="subjectName[]" class="w-full p-2 border rounded" required
                                    placeholder="Enter Subject Name">
                                <button type="button"
                                    class="ml-2 text-red-500 text-2xl removeSubject hidden">&times;</button>
                            </div>
                        </div>

                        <!-- Add More Button -->
                        <button type="button" id="addMore"
                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 mb-4">
                            + Add More
                        </button>

                        <div class="flex justify-end gap-2">
                            <button type="button" id="closeModal"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit</button>
                        </div>
                    </form>
                </div>
            </div>



        </div>
        <div>

            <!-- JavaScript -->
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const addSubjectBtn = document.getElementById("addSubjectBtn");
                    const formModal = document.getElementById("formModal");
                    const closeForm = document.getElementById("closeForm");
                    const closeModal = document.getElementById("closeModal");
                    const subjectForm = document.getElementById("subjectForm");
                    const addMoreBtn = document.getElementById("addMore");
                    const subjectFields = document.getElementById("subjectFields");
                    const subjectTable = document.getElementById("subjectTable").querySelector("tbody");

                    let count = 0;

                    // Open the "Add Subject" Modal
                    addSubjectBtn.addEventListener("click", function() {
                        formModal.classList.remove("hidden");
                    });

                    // Close the Modal (X Button)
                    closeForm.addEventListener("click", function() {
                        formModal.classList.add("hidden");
                    });

                    // Close the Modal (Cancel Button)
                    closeModal.addEventListener("click", function() {
                        formModal.classList.add("hidden");
                    });

               
                // Add More Input Field (Fix)
                addMoreBtn.addEventListener("click", function() {
                    const newField = document.createElement("div");
                    newField.classList.add("mb-4", "flex", "items-center");
                    newField.innerHTML = `
            <input type="text" name="subjectName[]" class="w-full p-2 border rounded" required placeholder="Enter Subject Name">
            <button type="button" class="ml-2 text-red-500 text-2xl removeSubject">&times;</button>
        `;
                    subjectFields.appendChild(newField);

                    updateRemoveButtons();
                });

                // Remove Subject Field
                subjectFields.addEventListener("click", function(event) {
                    if (event.target.classList.contains("removeSubject")) {
                        event.target.parentElement.remove();
                        updateRemoveButtons();
                    }
                });

                // Show Delete Button Only if More than One Field Exists
                function updateRemoveButtons() {
                    const removeButtons = document.querySelectorAll(".removeSubject");
                    removeButtons.forEach((btn, index) => {
                        btn.style.display = removeButtons.length > 1 ? "block" : "none";
                    });
                }
            });
                function openEditModel(s) {
                    document.getElementById('viewEditModal').classList.remove('hidden');
                    const editId = s.getAttribute('data-edit-uuid');
                    const editClassName = s.getAttribute('data-edit-className');
                    const editSubjectName = s.getAttribute('data-edit-subjectName');
                    document.querySelector('#viewEditContent').innerHTML = `
                   <form method="POST" action="{{ route('subjectWithClassUpdate') }}">
                         @extends('admin-panel.index')
                        @csrf
                            <input type="hidden" name="subjectId" value="${editId}">
                        <!-- Select Class -->
                        <div class="mb-4">
                            <label for="className" class="block text-gray-700">Select Class</label>
                            {{-- {{ $className }} --}}

                            @if (isset($className))
                                <select name="classId"
                                    class="block mt-1 p-2 w-full shadow-md focus:ring-2 focus:ring-indigo-500 focus:outline-none rounded-md">
                                    <option value="" disabled>Select a Class Name</option>
                                    @foreach ($className as $classStudent)
                                        <option value="{{ $classStudent->uuid }}">{{ $classStudent->class }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>

                        <!-- Subject Name Input -->
                        <div class="mb-4">
                            <label for="subjectName" class="block text-gray-700">Subject Name</label>
                            <input type="text" id="subjectName" name="subjectName" class="w-full p-2 border rounded" value="${editSubjectName}"
                                required>
                        </div>



                        <div>
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                        </div>
                    </form>
                `;
                }

                function closeEditModel() {
                    document.getElementById('viewEditModal').classList.add('hidden');
                }
            </script>
        @endsection

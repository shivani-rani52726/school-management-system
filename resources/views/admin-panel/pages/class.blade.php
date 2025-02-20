@extends('admin-panel.index')

@section('admin-panel')
    <!-- Main Container -->
    <div class="bg-gray-100 py-10 px-5">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-full">
            <div class="container mx-auto relative">
                <!-- Header -->
                <div class="text-center mb-5">
                    <h1 class="text-3xl font-semibold text-center mb-6">Class Management</h1>
                </div>

                @if (session('success'))
                    <div class="msg-hide text-left bg-green-200 my-3 p-2">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Add Class Button -->
                <div class="text-right mb-4">
                    <button id="addClassBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add
                        Class</button>
                </div>
                <!-- Class Table -->
                <div class="mt-5">
                    <h2 class="text-xl font-bold text-gray-700 mb-4">Class List</h2>
                    <table class="table-auto w-full bg-white border rounded shadow text-center">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-2 border">Class Name</th>
                                <th class="p-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="studentTableBody">
                            @if (isset($allClassRecord))
                                @foreach ($allClassRecord as $classRecord)
                                    <tr>
                                        <td class="text-center py-2">{{ $classRecord->class }}</td>
                                        <td class="flex justify-center items-center text-center py-2">

                                            <button type="button" class="bg-green-500 text-white px-4 py-2 rounded-md m-1"
                                                id="showEditModel" onclick="openEditModel(this)"
                                                data-edit-uuid="{{ $classRecord->uuid }}"
                                                data-edit-className="{{ $classRecord->class }}">Edit</button>

                                         <form method="POST"
                                                action="{{ route('classNameDelete', $classRecord->uuid) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                    class="bg-red-500 text-white px-4 py-2 rounded-md m-1"
                                                    id="showDeleteModel">Delete</button>
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

            <!-- Class Form Modal -->
            <div id="formModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-6 rounded shadow-lg w-full max-w-md relative">

                    <!-- Close Button (X) -->
                    <button id="closeForm"
                        class="absolute top-2 right-2 text-gray-700 text-3xl font-bold hover:text-red-600">
                        &times;
                    </button>

                    <h2 class="text-xl font-bold mb-4">Add Class</h2>
                    <form method="POST" action="{{ route('studentClassSubmit') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="className" class="block text-gray-700">Class Name</label>
                            <input type="text" id="className" name="className" class="w-full p-2 border rounded"
                                required>
                        </div>

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
    </div>

    <!-- JavaScript -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const addClassBtn = document.getElementById("addClassBtn");
            const formModal = document.getElementById("formModal");
            const closeForm = document.getElementById("closeForm");
            const closeModal = document.getElementById("closeModal");

            let count = 0;

            // Open the "Add Class" Modal
            addClassBtn.addEventListener("click", function() {
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

        });

        function openEditModel(s) {
            document.getElementById('viewEditModal').classList.remove('hidden');
            const editUuid = s.getAttribute('data-edit-uuid');
            const editClassName = s.getAttribute('data-edit-ClassName');
            document.querySelector('#viewEditContent').innerHTML = `
                  <form  method="POST" action="{{ route('classNameUpdate') }}">
                         @method('PUT')
                        @csrf
                         <input type="hidden" name="classId" value="${editUuid}"> 
                        <div class="mb-4">
                            <label for="className" class="block text-gray-700">Class Name</label>
                            <input type="text" id="className" name="className" class="w-full p-2 border rounded" value="${editClassName}"
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

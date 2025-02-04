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
                                <th class="p-2 border">School Name</th>
                                <th class="p-2 border">Teacher Name</th>
                                <th class="p-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Rows will be added dynamically -->
                        </tbody>
                    </table>
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
                    <form id="teacherForm">
                        <div class="mb-4">
                            <label for="schoolName" class="block text-gray-700">School Name</label>
                            <input type="text" id="schoolName" name="schoolName" class="w-full p-2 border rounded"
                                required>
                        </div>

                        <!-- Teacher Inputs -->
                        <div id="teacherInputs">
                            <div class="flex items-center gap-2 mb-2">
                                <input type="text" name="teacherName[]" class="w-full p-2 border rounded"
                                    placeholder="Enter Teacher Name" required>
                                <button type="button"
                                    class="deleteInput bg-red-500 text-white px-2 py-1 rounded">✖</button>
                            </div>
                        </div>

                        <!-- Add More Button -->
                        <button type="button" id="addMore"
                            class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                            Add More
                        </button>

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


            // Add More Teacher Fields
            addMoreBtn.addEventListener('click', () => {
                const div = document.createElement('div');
                div.classList.add("flex", "items-center", "gap-2", "mb-2");
                div.innerHTML = `
                <input type="text" name="teacherName[]" class="w-full p-2 border rounded" placeholder="Enter Teacher Name" required>
                <button type="button" class="deleteInput bg-red-500 text-white px-2 py-1 rounded">✖</button>
            `;
                teacherInputs.appendChild(div);
            });

            // Delete Individual Input Field
            teacherInputs.addEventListener('click', (e) => {
                if (e.target.classList.contains('deleteInput')) {
                    e.target.parentElement.remove();
                }
            });

            // Form Submit
            teacherForm.addEventListener('submit', (e) => {
                e.preventDefault();

                const schoolName = document.getElementById('schoolName').value;
                const teacherNames = [...document.querySelectorAll('input[name="teacherName[]"]')].map(
                    input => input.value);

                teacherNames.forEach(teacherName => {
                    count++;
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td class="p-2 border">${schoolName}</td>
                    <td class="p-2 border">${teacherName}</td>
                    <td class="p-2 border">
                        <button class="editBtn bg-green-500 text-white px-4 py-2 rounded-md m-1">Edit</button>
                        <button class="deleteRow bg-red-500 text-white px-4 py-2 rounded-md m-1">Delete</button>
                    </td>
                `;
                    teacherTable.appendChild(row);
                });

                // Close Modal
                formModal.classList.add('hidden');
                teacherForm.reset();
                teacherInputs.innerHTML = `
                <div class="flex items-center gap-2 mb-2">
                    <input type="text" name="teacherName[]" class="w-full p-2 border rounded" placeholder="Enter Teacher Name" required>
                    <button type="button" class="deleteInput bg-red-500 text-white px-2 py-1 rounded">✖</button>
                </div>
            `;
            });

            // Delete Row from Table
            teacherTable.addEventListener('click', (e) => {
                if (e.target.classList.contains('deleteRow')) {
                    e.target.closest('tr').remove();
                }
            });
        });
    </script>
@endsection

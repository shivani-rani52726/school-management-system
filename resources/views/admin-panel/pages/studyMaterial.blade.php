@extends('admin-panel.index')

@section('admin-panel')
    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Study Material Management</h2>

        {{-- Success Message --}}
        @if(session('success'))
        <div id="successMessage" class="bg-green-500 text-white p-3 rounded-md text-center">
            {{ session('success') }}
        </div>
    @endif
    

        {{-- Upload Study Material Form --}}
        <form action="{{ route('studyMaterial.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white p-6 rounded shadow-md">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700">Title:</label>
                    <input type="text" name="title" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Material Type:</label>
                    <select name="material_type" id="material_type" class="w-full p-2 border rounded" required
                        onchange="toggleDueDate()">
                        <option value="Assignment">Assignment</option>
                        <option value="Notes">Notes</option>
                        <option value="Quiz">Quiz</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Class Name:</label>
                    <input type="text" name="class_name" class="w-full p-2 border rounded" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Subject Name:</label>
                    <input type="text" name="subject_name" class="w-full p-2 border rounded" required>
                </div>

                {{-- Due Date (Visible Only for Assignments and Quizzes) --}}
                <div class="mb-4" id="due_date_field">
                    <label class="block text-gray-700">Due Date:</label>
                    <input type="date" name="due_date" class="w-full p-2 border rounded">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Upload File:</label>
                    <input type="file" name="file" class="w-full p-2 border rounded" required>
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Upload</button>
        </form>

        {{-- Study Material Table --}}
        <h3 class="text-xl font-bold mt-8">Uploaded Study Materials</h3>  
        <table class="w-full mt-4 border text-center">
            <thead>
                <tr class="bg-gray-200">
                    <th class="py-2 px-4 border">Title</th>
                    <th class="py-2 px-4 border">Type</th>
                    <th class="py-2 px-4 border">Class</th>
                    <th class="py-2 px-4 border">Subject</th>
                    <th class="py-2 px-4 border">Due Date</th>
                    <th class="py-2 px-4 border">File</th>
                    <th class="py-2 px-4 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($materials as $material)
                    <tr>
                        <td class="py-2 px-4 border">{{ $material->title }}</td>
                        <td class="py-2 px-4 border">{{ $material->material_type }}</td>
                        <td class="py-2 px-4 border">{{ $material->class_name }}</td>
                        <td class="py-2 px-4 border">{{ $material->subject_name }}</td>
                        <td class="py-2 px-4 border">
                            {{ $material->due_date ?? 'N/A' }}
                        </td>
                        <td class="py-2 px-4 border">
                            <a href="{{ route('studyMaterial.download', $material->id) }}"
                                class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                Download
                            </a>
                        </td>
                        <td class="py-2 px-4 border">
                            <form action="{{ route('studyMaterial.destroy', $material->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Hide Due Date for Notes --}}
    <script>
        function toggleDueDate() {
            var type = document.getElementById("material_type").value;
            var dueDateField = document.getElementById("due_date_field");

            if (type === "Notes" || type === "Other") {
                dueDateField.style.display = "none";
            } else {
                dueDateField.style.display = "block";
            }
        }

        // Call on page load
        document.addEventListener("DOMContentLoaded", function() {
            toggleDueDate();
        });
         // 3 seconds (3000ms) ke baad message hide karne ka function
    setTimeout(function() {
        document.getElementById('successMessage')?.remove();
    }, 3000);
    </script>
@endsection

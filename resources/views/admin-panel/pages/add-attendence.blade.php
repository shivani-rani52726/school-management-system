@extends('admin-panel.index')

@section('admin-panel')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="p-4">
        <h1 class="text-3xl font-bold mb-6">Add Attendance</h1>

        <div class="mt-6 bg-gray-100 p-4 rounded shadow">
            <div class="flex gap-4 mb-4">
                <div>
                    <label class="block mb-1">Class</label>
                    @if (isset($className))
                        <select id="classSelect" class="border p-2 rounded w-32" onchange="fetchStudentsByClass(this.value)">
                            <option value="" disabled selected>Select Class</option>
                            @foreach ($className as $classStudent)
                                <option value="{{ $classStudent->uuid }}">{{ $classStudent->class }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
            </div>

            <table class="table-auto w-full bg-white shadow-md rounded text-center">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Roll No</th>
                        <th class="px-4 py-2">Date</th>
                        <th class="px-4 py-2">Status</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function fetchStudentsByClass(classId) {
            if (!classId) return;

            fetch(`/admin/get-students-by-class/${classId}`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('studentTableBody');
                    tbody.innerHTML = '';

                    data.students.forEach(student => {
                        tbody.innerHTML += `
                            <tr data-student="${student.rollNo}">
                                <td class="text-center py-2">${student.stu_name}</td>
                                <td class="text-center py-2">${student.rollNo}</td>
                                <td class="text-center py-2">${new Date().toLocaleDateString()}</td>
                                <td class="text-center py-2">
                                    <div class="flex justify-center gap-2" id="status-${student.rollNo}">
                                        <button onclick="markAttendance('${student.stu_name}', '${student.rollNo}', 'Present')" class="bg-blue-500 text-white px-4 py-2 rounded">Present</button>
                                        <button onclick="markAttendance('${student.stu_name}', '${student.rollNo}', 'Absent')" class="bg-red-500 text-white px-4 py-2 rounded">Absent</button>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                });
        }

        function markAttendance(name, rollNo, status) {
            fetch('/admin/mark-attendance', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    student_name: name,
                    rollNo: rollNo,
                    date: new Date().toISOString().split('T')[0],
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                const statusCell = document.getElementById(`status-${rollNo}`);
                statusCell.innerHTML = `
                    <span class="px-3 py-1 rounded text-white ${status === 'Present' ? 'bg-green-600' : 'bg-red-600'}">
                        ${status}
                    </span>
                `;
            })
        }
    </script>
@endsection

@extends('admin-panel.index')

@section('admin-panel')
<<<<<<< Updated upstream
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
=======
<div class="p-4">
    <h1 class="text-3xl font-bold mb-6">Add Attendance</h1>

    <button onclick="openForm()" class="bg-blue-600 text-white px-4 py-2 rounded">Add Attendance</button>

    <!-- Attendance Form -->
    <div id="attendanceForm" class="hidden mt-6 bg-gray-100 p-4 rounded shadow">
        <div class="flex gap-4 mb-4">
            <div>
                <label class="block mb-1">Month</label>
                <select id="monthSelect" class="border p-2 rounded w-full">
                    <option value="">Select Month</option>
                    <option>January</option>
                    <option>February</option>
                    <option>March</option>
                    <option>April</option>
                    <option>May</option>
                    <option>June</option>
                    <option>July</option>
                    <option>August</option>
                    <option>September</option>
                    <option>October</option>
                    <option>November</option>
                    <option>December</option>
                </select>
            </div>
            <div>
                <label class="block mb-1">Date</label>
                <input type="date" id="dateInput" class="border p-2 rounded w-full">
            </div>
        </div>

        <div id="studentsArea" class="space-y-2">
            <div class="flex gap-4">
                <input type="text" placeholder="Roll No" class="border p-2 rounded w-24">
                <input type="text" placeholder="Name" class="border p-2 rounded flex-1">
                <select class="border p-2 rounded w-32">
                    <option value="Present">Present</option>
                    <option value="Absent">Absent</option>
                </select>
            </div>
        </div>

        <button onclick="addStudentRow()" class="mt-3 text-sm text-blue-600">+ Add Another Student</button><br>

        <button onclick="saveAttendance()" class="bg-green-600 text-white px-4 py-2 rounded mt-4">Submit</button>
    </div>

    <!-- Attendance Display Area -->
    <div id="attendanceCards" class="mt-8 space-y-6"></div>
</div>

<script>
    let allAttendanceData = {};

    function openForm() {
        document.getElementById('attendanceForm').classList.remove('hidden');
    }

    function addStudentRow() {
        const area = document.getElementById('studentsArea');
        const row = document.createElement('div');
        row.className = 'flex gap-4 mt-2';
        row.innerHTML = `
            <input type="text" placeholder="Roll No" class="border p-2 rounded w-24">
            <input type="text" placeholder="Name" class="border p-2 rounded flex-1">
            <select class="border p-2 rounded w-32">
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
            </select>
        `;
        area.appendChild(row);
    }

    function saveAttendance() {
        const month = document.getElementById('monthSelect').value;
        const date = document.getElementById('dateInput').value;
        const rows = document.querySelectorAll('#studentsArea > div');
        const students = [];

        rows.forEach(row => {
            const inputs = row.querySelectorAll('input, select');
            const roll = inputs[0].value;
            const name = inputs[1].value;
            const status = inputs[2].value;
            if (roll && name && status) {
                students.push({ roll, name, status });
            }
        });

        if (!allAttendanceData[month]) {
            allAttendanceData[month] = [];
        }

        let existingDateEntry = allAttendanceData[month].find(entry => entry.date === date);

        if (existingDateEntry) {
            existingDateEntry.students.push(...students);
        } else {
            allAttendanceData[month].push({
                date,
                students
            });
        }

        document.getElementById('attendanceForm').classList.add('hidden');
        renderAttendanceCards();
    }

    function renderAttendanceCards() {
        const container = document.getElementById('attendanceCards');
        container.innerHTML = '';

        for (let month in allAttendanceData) {
            const monthTitle = document.createElement('h2');
            monthTitle.className = 'text-2xl font-bold text-indigo-700';
            monthTitle.textContent = month;
            container.appendChild(monthTitle);

            allAttendanceData[month].forEach(entry => {
                const card = document.createElement('div');
                card.className = 'bg-white shadow-md p-4 rounded';
                card.innerHTML = `<h3 class="text-lg font-semibold mb-2 text-gray-800">Date: ${entry.date}</h3><div id="table-${month}-${entry.date}"></div>`;
                container.appendChild(card);

                renderPaginatedTable(`table-${month}-${entry.date}`, entry.students);
            });
        }
    }

    function renderPaginatedTable(containerId, students) {
        const container = document.getElementById(containerId);
        container.innerHTML = '';
        let currentPage = 1;
        const rowsPerPage = 10;

        function renderTablePage(page) {
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const slicedStudents = students.slice(start, end);

            let table = `<table class="w-full text-sm text-left border mb-2">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="p-2 border">Roll No</th>
                        <th class="p-2 border">Name</th>
                        <th class="p-2 border">Status</th>
                    </tr>
                </thead>
                <tbody>`;

            slicedStudents.forEach(student => {
                table += `
                    <tr>
                        <td class="p-2 border">${student.roll}</td>
                        <td class="p-2 border">${student.name}</td>
                        <td class="p-2 border">${student.status}</td>
                    </tr>`;
            });

            table += `</tbody></table>`;
            container.innerHTML = table;

            // Pagination
            const totalPages = Math.ceil(students.length / rowsPerPage);
            if (totalPages > 1) {
                let paginationHTML = `<div class="flex gap-2">`;
                for (let i = 1; i <= totalPages; i++) {
                    paginationHTML += `<button onclick="changePage('${containerId}', ${i})" class="px-3 py-1 rounded ${i === page ? 'bg-blue-600 text-white' : 'bg-gray-300'}">${i}</button>`;
                }
                paginationHTML += `</div>`;
                container.innerHTML += paginationHTML;
            }
        }

        window.changePage = function (id, page) {
            if (id === containerId) {
                renderTablePage(page);
            }
        };

        renderTablePage(currentPage);
    }
</script>
>>>>>>> Stashed changes
@endsection

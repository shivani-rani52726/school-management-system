<x-app-layout>
    <h2 class="text-3xl font-bold text-center my-6">📅 View Attendance</h2>

    <div class="container mx-auto px-4">
        <!-- Search Filter -->
        <div class="mb-4 flex justify-between items-center">
            <input type="text" id="search" placeholder="🔍 Search by student name..." 
                class="w-full md:w-1/3 p-2 border rounded-lg shadow-sm focus:ring focus:ring-blue-300">
        </div>

        <!-- Attendance Table -->
        <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-6">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-blue-500 text-white text-left">
                        <th class="p-3">👤 Student</th>
                        <th class="p-3">📆 Date</th>
                        <th class="p-3">✅ Status</th>
                    </tr>
                </thead>
                <tbody id="attendanceTable">
                    @foreach ($attendanceRecords as $record)
                        <tr class="border-b text-gray-700 
                            {{ $record->status == 'Present' ? 'bg-green-100' : 'bg-red-100' }}">
                            <td class="p-3">{{ $record->student_name }}</td>
                            <td class="p-3">{{ $record->date }}</td>
                            <td class="p-3 font-bold">
                                <span class="px-3 py-1 rounded 
                                    {{ $record->status == 'Present' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                    {{ $record->status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- JavaScript for Search Functionality -->
    <script>
        document.getElementById("search").addEventListener("keyup", function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#attendanceTable tr");
            
            rows.forEach(row => {
                let student = row.cells[0].innerText.toLowerCase();
                row.style.display = student.includes(filter) ? "" : "none";
            });
        });
    </script>
</x-app-layout>

<x-app-layout>
    <h2 class="text-3xl font-bold text-center my-6">📝 Add Attendance</h2>

    <div class="container mx-auto px-4">
        <form action="{{ route('attendance.store') }}" method="POST" class="bg-white shadow-lg p-6 rounded-lg">
            @csrf
            <label class="block mb-2">👤 Student Name</label>
            <input type="text" name="student_name" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2">📆 Date</label>
            <input type="date" name="date" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2">📚 Subject</label>
            <input type="text" name="subject" class="w-full p-2 border rounded mb-4" required>

            <label class="block mb-2">✅ Status</label>
            <select name="status" class="w-full p-2 border rounded mb-4" required>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
            </select>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save Attendance</button>
        </form>
    </div>
</x-app-layout>

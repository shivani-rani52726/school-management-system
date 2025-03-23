<x-app-layout>
    <h2 class="text-3xl font-bold text-center my-6">📊 Student Results</h2>

    <div class="text-center mb-4">
        <a href="#" class="bg-green-500 text-white px-4 py-2 rounded">➕ Add New Result</a>
    </div>

    <div class="container mx-auto px-4">
        <table class="w-full border-collapse border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border p-2">Student Name</th>
                    <th class="border p-2">Subject</th>
                    <th class="border p-2">Marks Obtained</th>
                    <th class="border p-2">Total Marks</th>
                    <th class="border p-2">Percentage</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result)
                    <tr class="text-center">
                        <td class="border p-2">{{ $result->student_name }}</td>
                        <td class="border p-2">{{ $result->subject }}</td>
                        <td class="border p-2">{{ $result->marks_obtained }}</td>
                        <td class="border p-2">{{ $result->total_marks }}</td>
                        <td class="border p-2">{{ round(($result->marks_obtained / $result->total_marks) * 100, 2) }}%</td>
                        <td class="border p-2">
                            <form action="{{ route('results.destroy', $result->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">🗑 Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

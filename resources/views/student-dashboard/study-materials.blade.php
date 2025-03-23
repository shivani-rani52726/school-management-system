<x-app-layout>
    <div class="container mx-auto p-6">
        <h2 class="text-3xl font-bold mb-6 text-gray-800">📚 Study Materials</h2>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-blue-600 text-white text-left">
                        <th class="px-6 py-3 border-b">Title</th>
                        <th class="px-6 py-3 border-b">Type</th>
                        <th class="px-6 py-3 border-b">Class</th>
                        <th class="px-6 py-3 border-b">Subject</th>
                        <th class="px-6 py-3 border-b">Due Date</th>
                        <th class="px-6 py-3 border-b">Download</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($materials as $material)
                        <tr class="border-b even:bg-gray-100 hover:bg-gray-200 transition">
                            <td class="px-6 py-4">{{ $material->title }}</td>
                            <td class="px-6 py-4">{{ $material->material_type }}</td>
                            <td class="px-6 py-4">{{ $material->class_name }}</td>
                            <td class="px-6 py-4">{{ $material->subject_name }}</td>
                            <td class="px-6 py-4">
                                {{ $material->due_date ? \Carbon\Carbon::parse($material->due_date)->format('d-m-Y') : 'N/A' }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('studyMaterial.download', $material->id) }}" 
                                    class="text-decoration-none bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600 transition">
                                    ⬇ Download
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>


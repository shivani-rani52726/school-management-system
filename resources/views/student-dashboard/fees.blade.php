<x-app-layout>
    <h2 class="text-3xl font-bold text-center my-6">💰 View Fees</h2>

    <div class="text-center mb-4">
        <a href="{{ route('fees.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">➕ Add Fee Record</a>
    </div>

    @if(session('success'))
        <div class="bg-green-500 text-white text-center py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mx-auto px-4">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="py-3 px-6">Student Name</th>
                        <th class="py-3 px-6">Student ID</th>
                        <th class="py-3 px-6">Total Fees</th>
                        <th class="py-3 px-6">Paid Fees</th>
                        <th class="py-3 px-6">Due Fees</th>
                        <th class="py-3 px-6">Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fees as $fee)
                        <tr class="border-b text-center">
                            <td class="py-3 px-6">{{ $fee->student_name }}</td>
                            <td class="py-3 px-6">{{ $fee->student_id }}</td>
                            <td class="py-3 px-6 text-green-600 font-bold">₹{{ $fee->total_fees }}</td>
                            <td class="py-3 px-6 text-blue-600 font-bold">₹{{ $fee->paid_fees }}</td>
                            <td class="py-3 px-6 text-red-600 font-bold">₹{{ $fee->due_fees }}</td>
                            <td class="py-3 px-6">{{ $fee->due_date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <h2 class="text-3xl font-bold text-center my-6">➕ Add Fee Record</h2>

    <div class="container mx-auto px-4">
        <div class="max-w-lg mx-auto bg-white shadow-lg p-6 rounded-lg">
            <form action="{{ route('fees.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">Student Name</label>
                    <input type="text" name="student_name" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Student ID</label>
                    <input type="text" name="student_id" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Total Fees (₹)</label>
                    <input type="number" name="total_fees" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Paid Fees (₹)</label>
                    <input type="number" name="paid_fees" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Due Fees (₹)</label>
                    <input type="number" name="due_fees" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">Due Date</label>
                    <input type="date" name="due_date" class="w-full px-4 py-2 border rounded-lg" required>
                </div>

                <button type="submit" class="w-full bg-indigo-500 text-white py-3 rounded-lg">Save Record</button>
            </form>
        </div>
    </div>
</x-app-layout>

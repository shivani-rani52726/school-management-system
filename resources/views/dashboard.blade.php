<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

   
<div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold mb-6 text-center">Student Dashboard</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Study Material -->
        <div class="bg-white shadow-lg p-4 rounded-lg">
            <h3 class="text-xl font-semibold mb-2">📚 Study Materials</h3>
            <p>Download your study materials and notes.</p>
            <a href="{{ route('student.studyMaterials') }}" class="text-decoration-none block bg-blue-500 text-white text-center py-2 rounded mt-3 hover:bg-blue-600">
                View Materials
            </a>
            
            
        </div>

        <!-- Notes Section -->
        {{-- <div class="bg-white shadow-lg p-4 rounded-lg">
            <h3 class="text-xl font-semibold mb-2">📝 My Notes</h3>
            <p>Write, save and download your notes as PDF.</p>
            <a href="{{ route('notes.create') }}" class="block bg-green-500 text-white text-center py-2 rounded mt-3 hover:bg-green-600">
                Create Notes
            </a>
            
        </div> --}}
        <div class="bg-white shadow-lg p-4 rounded-lg">
            <h3 class="text-xl font-semibold mb-2">📝 My Notes</h3>
            <p>Write, save, and view your notes anytime.</p>
            <a href="{{ route('notes.myNotes') }}" class="text-decoration-none block bg-green-500 text-white text-center py-2 rounded mt-3 hover:bg-green-600">
                View Notes
            </a>
        </div>

        <!-- Exam Preparation -->
        <div class="bg-white shadow-lg p-4 rounded-lg">
            <h3 class="text-xl font-semibold mb-2">📖 Exam Preparation</h3>
            <p>Practice important questions and quizzes.</p>
            <a href="{{ route('quiz.index') }}" class="text-decoration-none block bg-purple-500 text-white text-center py-2 rounded mt-3 hover:bg-purple-600">Start Preparing</a>
        </div>

        <!-- Attendance -->
        <div class="bg-white shadow-lg p-4 rounded-lg">
            <h3 class="text-xl font-semibold mb-2">📅 Attendance</h3>
            <p>Check your attendance records.</p>
            <a href="{{ route('attendance.view') }}" class="text-decoration-none block bg-yellow-500 text-white text-center py-2 rounded mt-3 hover:bg-yellow-600">View Attendance</a>
        </div>

        <!-- Results -->
        <div class="bg-white shadow-lg p-4 rounded-lg">
            <h3 class="text-xl font-semibold mb-2">📊 My Results</h3>
            <p>View your exam scores and grades.</p>
            <a href="{{ route('results.index') }}" class="text-decoration-none block bg-red-500 text-white text-center py-2 rounded mt-3 hover:bg-red-600">Check Results</a>
        </div>

        <!-- Fees -->
        <div class="bg-white shadow-lg p-4 rounded-lg">
            <h3 class="text-xl font-semibold mb-2">💰 Fee Status</h3>
            <p>Check your fee payments and due dates.</p>
            <a href="{{ route('fees.index') }}" class="text-decoration-none block bg-indigo-500 text-white text-center py-2 rounded mt-3 hover:bg-indigo-600">View Fees</a>
        </div>

        
        
    </div>
</div>


</x-app-layout>

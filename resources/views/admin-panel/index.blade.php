<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    
     @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>

        </style>
    @endif

</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white flex flex-col">
            <div class="p-6 text-2xl font-bold">Admin Dashboard</div>
            <nav class="flex-grow">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin-dashboard') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('registeration')}}" class="block py-2 px-4 hover:bg-gray-700 rounded">All Registration</a>
                    </li>
                    <li>
                        <a href="{{ route('roles')}}" class="block py-2 px-4 hover:bg-gray-700 rounded">Roles</a>
                    </li>
                    <li>
                        <a href="{{ route('student-details') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Student Details</a>
                    </li> 
                    <li>
                        <a href="{{ route('teacher-details') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Teacher Details</a>
                    </li>
                    <li>
                        <a href="{{ route('school-details') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">School Name</a>
                    </li>
                    <li>
                        <a href="{{ route('teachers') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Teacher With School Name</a>
                    </li>
                   
                    <li>
                        <a href="{{ route('class') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Class</a>
                    </li>
                    <li>
                        <a href="{{ route('subjects') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">Subject With Class</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-700 rounded">Study Material</a>
                    </li>
                    {{-- <li>
                        <a href="#" class="block py-2 px-4 hover:bg-gray-700 rounded">Settings</a>
                    </li> --}}
                </ul>
            </nav>
            <div class="p-4 border-t border-gray-700 text-center">
                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded">Logout</button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-grow p-8">
            @yield('admin-panel')
        </main>
    </div>
</body>
</html>

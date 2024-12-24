<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>

        </style>
    @endif
    <style>
        .hero-bg {
            background-image: url('https://media.istockphoto.com/id/1072470136/photo/students-learning-computer-programming-stock-image.jpg?s=1024x1024&w=is&k=20&c=uGR4TQBGCB_rbuztr0aiSg-0x7XOsOx-rif7eTxbPY8=');
            background-size: cover;
            background-position: center;
        }

        .gradient-overlay {
            background: rgba(0, 0, 0, 0.6);
        }

        .btn-hover:hover {
            transform: scale(1.05);
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<body class="font-roboto bg-gray-50 antialiased">
    <!-- Main Container -->
    <div class="hero-bg relative min-h-screen flex items-center justify-center text-white">
        <div class="gradient-overlay absolute inset-0"></div>
        <div class="relative z-10 text-center px-6 lg:px-20">
            <h1 class="text-4xl font-bold lg:text-6xl">
                Welcome to <span class="text-[#FF2D20]">School Management System</span>
            </h1>
            <p class="mt-4 text-lg lg:text-2xl text-gray-200">
                Simplify your school management with an all-in-one solution for students, principals, and
                administrators.
            </p>

            <!-- Buttons -->
            <div class="mt-8 flex flex-wrap justify-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="btn-hover bg-[#FF2D20] px-6 py-3 text-lg font-medium rounded-md shadow-lg">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="btn-hover bg-white text-[#FF2D20] px-6 py-3 text-lg font-medium rounded-md shadow-lg">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="btn-hover bg-[#FF2D20] px-6 py-3 text-lg font-medium rounded-md shadow-lg">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <section class="bg-gray-100 py-12">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Features of Our System</h2>
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <img src="https://media.istockphoto.com/id/537357602/photo/little-chemist.jpg?s=1024x1024&w=is&k=20&c=NZiD-sq1BVQ13XJ2w6OqP7BCy1HQS6cGgTyKoIGxc7U=" alt="Students" class="mx-auto mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Student Management</h3>
                    <p class="text-gray-600">Easily manage students' records and attendance.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <img src="https://media.istockphoto.com/id/1496098116/photo/a-happy-beautiful-blonde-businesswoman-looking-at-camera-while-holding-a-notebook.jpg?s=2048x2048&w=is&k=20&c=SIYge5fQGCmonO_EWPxGnSBf5iWBvk7KJlQvIOkcPd4=" alt="Principals" class="mx-auto mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Principal Dashboard</h3>
                    <p class="text-gray-600">Track and monitor school performance effortlessly.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <img src="https://media.istockphoto.com/id/1182697690/photo/beautiful-male-computer-engineer-and-scientists-create-neural-network-at-his-workstation.jpg?s=1024x1024&w=is&k=20&c=eGrVlLByIoED15AXoiohMBtfnNWcaf_komQjB_IRAAk=" alt="Admin" class="mx-auto mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Admin Control</h3>
                    <p class="text-gray-600">Full control over all users and schools in the system.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
                    <img src="https://media.istockphoto.com/id/958697476/photo/young-unrecognisable-female-college-student-in-class-taking-notes-and-using-highlighter.jpg?s=1024x1024&w=is&k=20&c=aM6qd8sy56ul5fdgZ-UcJrRuGqixAMicmDqoHsODpnU=" alt="Reports" class="mx-auto mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Comprehensive Reports</h3>
                    <p class="text-gray-600">Generate real-time reports for better decision making.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="text-center">
            <p>&copy; {{ date('Y') }} School Management System. All Rights Reserved.</p>
        </div>
    </footer>
</body>

</html>

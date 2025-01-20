@extends('admin-panel.index')
@section('admin-panel')

<div class="bg-gray-100  py-10">
    <!-- Header -->
    <header class="flex justify-between items-center mb-6 px-6">
        <h1 class="text-3xl font-semibold">Dashboard</h1>
        <div>
            <input type="text" placeholder="Search..." class="p-2 border border-gray-300 rounded-lg w-64">
        </div>
    </header>

    <!-- Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8 px-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-gray-700 font-bold">Total Students</h2>
            <p class="text-3xl mt-2 font-semibold">1,230</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-gray-700 font-bold">Active Courses</h2>
            <p class="text-3xl mt-2 font-semibold">45</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-gray-700 font-bold">New Registrations</h2>
            <p class="text-3xl mt-2 font-semibold">98</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-gray-700 font-bold">Pending Queries</h2>
            <p class="text-3xl mt-2 font-semibold">12</p>
        </div>
    </div>

    <!-- Table Section -->
    <section class="bg-white p-6 rounded-lg shadow-md mx-6">
        <h2 class="text-2xl font-bold mb-4">Recent Activities</h2>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-3 text-left">ID</th>
                    <th class="border p-3 text-left">Name</th>
                    <th class="border p-3 text-left">Date</th>
                    <th class="border p-3 text-left">Activity</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border p-3">1</td>
                    <td class="border p-3">Alice Johnson</td>
                    <td class="border p-3">2025-01-12</td>
                    <td class="border p-3">Enrolled in Course</td>
                </tr>
                <tr>
                    <td class="border p-3">2</td>
                    <td class="border p-3">Bob Smith</td>
                    <td class="border p-3">2025-01-11</td>
                    <td class="border p-3">Submitted Assignment</td>
                </tr>
                <tr>
                    <td class="border p-3">3</td>
                    <td class="border p-3">Claire Lee</td>
                    <td class="border p-3">2025-01-10</td>
                    <td class="border p-3">Joined Webinar</td>
                </tr>
            </tbody>
        </table>
    </section>
</div>

@endsection

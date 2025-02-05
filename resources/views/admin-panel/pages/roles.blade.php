@extends('admin-panel.index')
@section('admin-panel')
    <div class="bg-gray-100 py-10 px-5">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-full">
            <h1 class="text-3xl font-semibold text-center mb-6">Roles Page</h1>
            @if (session('success'))
                <div class="msg-hide text-left bg-green-200 my-3 p-2">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Add Role Button -->
            <button id="addRoleBtn" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Role</button>

            <!-- Role Form Modal -->
            <div id="roleFormModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex justify-center items-center hidden">
                <div class="bg-white p-6 rounded-md w-1/3 relative">
                    <button id="closeFormsym" class="absolute top-0 right-0 -mt-3 -mr-4 text-red px-4 py-2 rounded hover:text-red-500 text-xl font-bold">X</button>
                    <h2 class="text-xl font-semibold mb-4">Add Role</h2>
                    <form id="roleForm" method="POST" action="{{ route('roleSubmit') }}">
                        @csrf
                        <input type="hidden" id="editIndex" />
                        <div class="mb-4">
                            <label for="roleName" class="block text-sm font-medium text-gray-700">Role Name</label>
                            <input type="text" id="roleName" name="roleName"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="roleDescription" class="block text-sm font-medium text-gray-700">Role
                                Description</label>
                            <input type="text" id="roleDescription" name="roleDescription"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Save</button>
                            <button id="closeFormBtn" class="bg-red-500 text-white px-4 py-2 rounded-md mt-4">Close</button>
                        </div>
                    </form>
                </div>
            </div>
          


            <!-- Roles Table -->
            <div class="mt-8">
                <h3 class="text-xl font-semibold mb-4">Roles List</h3>

                <table id="rolesTable" class="min-w-full table-auto border-collapse bg-white shadow-md rounded-md">
                    <thead>
                        <tr class="text-center">
                            <th class="px-4 py-2 border-b">Role Name</th>
                            <th class="px-4 py-2 border-b">Description</th>
                            <th class="px-4 py-2 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="rolesTableBody">
                        @if (isset($allRoles))
                        @foreach ($allRoles as $role)
                            <tr>
                                <td class="text-center py-2">{{ $role->role_name }}</td>
                                <td class="text-center py-2">{{ $role->discriptions }}</td>
                                <td class="flex justify-center items-center text-center py-2">
                                    <form method="POST" action="{{ route('roleEdit') }}">
                                        @method('GET')
                                        @csrf
                                        <input type="hidden" name="roleId" value="{{$role->uuid}}">
                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md m-1"
                                        id="showEditModel">Edit</button>
                                    </form>
                                    <form method="POST" action="{{ route('destroy', $role->uuid) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md m-1"
                                            id="showDeleteModel">Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    <script>
        const addRoleBtn = document.getElementById('addRoleBtn');
        const roleFormModal = document.getElementById('roleFormModal');
        const closeFormBtn = document.getElementById('closeFormBtn');
        const roleForm = document.getElementById('roleForm');
       
        let roles = [];
        let editIndex = null;
        let deleteIndex = null;

        // Show form modal
        addRoleBtn.addEventListener('click', () => {
            editIndex = null;
            roleForm.reset();
            roleFormModal.classList.remove('hidden');
        });

        // Close form modal
        closeFormBtn.addEventListener('click', () => {
            roleFormModal.classList.add('hidden');
        });
        closeFormsym.addEventListener('click', () => {
            roleFormModal.classList.add('hidden');
        });

       
    </script>
@endsection

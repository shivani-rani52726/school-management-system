@extends('admin-panel.index')
@section('admin-panel')
    <div class="flex justify-center bg-gray-100 py-10">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-4xl">
            <h1 class="text-3xl font-semibold text-center mb-6">Users Registration</h1>
            @if (session('success'))
                <div class="msg-hide text-left bg-green-200 my-3 p-2">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('storeUser') }}">
                @csrf
                <div class="grid grid-cols-12 gap-6">
                    <!-- Name -->
                    <div class="col-span-12 sm:col-span-6">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name"
                            class="block mt-1 w-full shadow-md focus:ring-2 focus:ring-indigo-500 focus:outline-none rounded-md"
                            type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="col-span-12 sm:col-span-6">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email"
                            class="block mt-1 w-full shadow-md focus:ring-2 focus:ring-indigo-500 focus:outline-none rounded-md"
                            type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="col-span-12 sm:col-span-6">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password"
                            class="block mt-1 w-full shadow-md focus:ring-2 focus:ring-indigo-500 focus:outline-none rounded-md"
                            type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-span-12 sm:col-span-6">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation"
                            class="block mt-1 w-full shadow-md focus:ring-2 focus:ring-indigo-500 focus:outline-none rounded-md"
                            type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    {{-- roles --}}
                    <div class="col-span-12 sm:col-span-12">
                        <label for="role" class="block font-medium text-sm text-gray-700">Role</label>
                        {{-- {{$allUsersRoles}} --}}
                        @if (isset($allUsersRoles))
                            <select name="roleId"
                                class="block mt-1 p-2 w-full shadow-md focus:ring-2 focus:ring-indigo-500 focus:outline-none rounded-md">
                                <option value="" disabled selected>Select a Role</option>
                                @foreach ($allUsersRoles as $roles)
                                    <option value='{{ $roles->uuid }}'>{{ $roles->role_name }}</option>
                                @endforeach
                            </select>
                        @else
                            <select>
                                <option value="" disabled selected>No Rolls Found</option>
                            </select>
                        @endif

                    </div>
                </div>

                <div class="flex items-center justify-between mt-6">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ml-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>




        </div>


    </div>
{{-- model for view button --}}
    <div id="viewModal"
        class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden">
        <div class="bg-white rounded shadow-lg w-full max-w-lg p-5 relative">
            <button  class="absolute top-0 right-0 -mt-3 -mr-4 text-red px-4 py-2 rounded hover:text-red-500 text-xl font-bold"
            onclick="closeModel()">X</button>
            <h2 class="text-xl font-bold text-gray-700 mb-3">View User Details</h2>
            <div id="viewContent" class="text-left"></div>

            <div class="text-center mt-4">
                <button  class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                    onclick="closeModel()">Close</button>
            </div>
        </div>

    </div>
{{-- model for edit button --}}
    <div id="viewEditModal"
        class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden">
        <div class="bg-white rounded shadow-lg w-full max-w-lg p-5 relative">
            <button  class="absolute top-0 right-0 -mt-3 -mr-4 text-red px-4 py-2 rounded hover:text-red-500 text-xl font-bold"
            onclick="closeEditModel()">X</button>
            <h2 class="text-xl font-bold text-gray-700 mb-3">Edit User Details</h2>
            <div id="viewEditContent" class="text-left"></div>   
            <div class="text-right" style="margin-top:-40px">
                <button  class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                    onclick="closeEditModel()">Close</button>
            </div>
        </div>
    </div>

    <div class="flex justify-center bg-gray-100 py-10">

        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-4xl">

            <table class="table-auto w-full bg-white shadow-md rounded text-center">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2">Id</th>
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Role</th>
                        <th class="px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody id="teacherTableBody">
                    {{-- {{$allUsers}} --}}

                    @if (isset($allUsers))
                        @foreach ($allUsers as $users)
                            <tr>
                                <td class="text-center py-2">{{ $loop->iteration }}</td>
                                <td class="text-center py-2">{{ $users->name }}</td>
                                <td class="text-center py-2">{{ $users->email }}</td>
                                <td class="text-center py-2">
                                    {{ $allUsersRoles->where('uuid', $users->role_id)->first()->role_name ?? 'No Roles' }}
                                </td>
                                <td class="flex justify-center items-center text-center py-2">
                                    <button type="button" class="bg-green-500 text-white px-4 py-2 rounded-md m-1"
                                        onclick="openEditModel(this)" data-edit-userId="{{ $users->id }}" data-edit-name="{{ $users->name }}" data-edit-email="{{ $users->email }}" data-edit-role="{{ $allUsersRoles->where('uuid', $users->role_id)->first()->role_name }}">Edit</button>

                                    <form method="POST" action="{{ route('userDetailsDelete', $users->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded-md m-1">Delete</button>
                                    </form>

                                    <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md m-1"
                                        onclick="openModal(this)" data-id="{{ $users->id }}"
                                        data-name="{{ $users->name }}" data-email="{{ $users->email }}"
                                        data-role="{{ $allUsersRoles->where('uuid', $users->role_id)->first()->role_name }}">View</button>

                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <script>
        const viewModal = document.getElementById('viewModal');

        function openModal(s) {
            document.getElementById('viewModal').classList.remove('hidden');
            const viewId = s.getAttribute('data-id');
            const viewName = s.getAttribute('data-name');
            const viewEmail = s.getAttribute('data-email');
            const viewRole = s.getAttribute('data-role');
            document.querySelector('#viewContent').innerHTML = `
             <div class="flex justify-between">
                <div><strong>Id :</strong></div>
                <div>${viewId}</div>
            </div>
             <div class="flex justify-between">
                <div><strong>Name :</strong></div>
                <div>${viewName}</div>
            </div>
             <div class="flex justify-between">
                <div><strong>Email :</strong></div>
                <div>${viewEmail}</div>
            </div>
             <div class="flex justify-between">
                <div><strong>Role :</strong></div>
                <div>${viewRole}</div>
            </div>
          
            `;

        }

        function closeModel() {
            document.getElementById('viewModal').classList.add('hidden');
        }

        function openEditModel(a) {
            document.getElementById('viewEditModal').classList.remove('hidden');
            const editId = a.getAttribute('data-edit-userId');
            const editName = a.getAttribute('data-edit-name');
            const editEmail = a.getAttribute('data-edit-email');
            const editRole = a.getAttribute('data-edit-role');
            document.querySelector('#viewEditContent').innerHTML = `
              <form method="POST" action="{{ route('userDetailsUpdate') }}">
                @method('PUT')
                @csrf
                 <input type="hidden" name="UserId" value='${editId}'>

                <div class="grid grid-cols-12 gap-6">
                <!-- Name -->
                
                        <div class="col-span-12 sm:col-span-6">
                             <label for="userName" class="block font-medium text-sm text-gray-700">Name</label>
                             <input id="userName" type="text"  name="userName" required autofocus autocomplete="name" class="block p-2 mt-1 w-full shadow-md focus:ring-2 focus:ring-indigo-500 focus:outline-none rounded-md" value="${ editName }">
                        </div>
                         <!-- Email Address -->
                        <div class="col-span-12 sm:col-span-6">
                            <label for="UserEmail" class="block font-medium text-sm text-gray-700">Email</label>
                            <input id="UserEmail"  type="email" name="UserEmail" required autocomplete="username" class="block p-2 mt-1 w-full shadow-md focus:ring-2 focus:ring-indigo-500 focus:outline-none rounded-md" value="${ editEmail }">
                        </div>
                             {{-- roles --}}
                        <div class="col-span-12 sm:col-span-12">
                            <label for="role" class="block font-medium text-sm text-gray-700">Role</label>
                        @if (isset($allUsersRoles))
                            <select name="roleId"
                                class="block mt-1 p-2 w-full shadow-md focus:ring-2 focus:ring-indigo-500 focus:outline-none rounded-md">
                                <option value="" disabled>Select a Role</option>
                                @foreach ($allUsersRoles as $roles)
                                <option value='{{ $roles->uuid }}'>{{ $roles->role_name }}</option>
                                @endforeach
                            </select>
                        @endif

                        </div>
                     <div class="flex justify-between items-center gap-3">
                         <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                             Update
                        </button>
                
                    </div>

                 

                </div>
            </form>
             `;

        }

        function closeEditModel() {
            document.getElementById('viewEditModal').classList.add('hidden');
        }
    </script>
@endsection

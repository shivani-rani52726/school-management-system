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



            {{-- edit form model  --}}
            <div>
                <div class="bg-white p-6 rounded shadow-lg">
                    <form method="POST" action="{{ route('roleUpdate') }}">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="roleId" value="{{ $editRole->uuid }}">
                        <h2 class="text-xl font-semibold mb-4">Edit Role</h2>
                        <label for="roleName" class="block font-medium">Role Name:</label>
                        <input type="text" id="roleName" name="roleName" value="{{ $editRole->role_name }}"
                            class="border rounded w-full px-3 py-2 mb-4" required>
                        <label for="discriptions" class="block font-medium">Description:</label>
                        <input type="text" id="discriptions" name="discriptions" value="{{ $editRole->discriptions }}"
                            class="border rounded w-full px-3 py-2 mb-4" required>

                        <div class="flex justify-end">
                            <a href="{{ route('roles') }}" type="button" 
                                class="bg-red-500 text-white px-4 py-2 rounded-md mr-2">Cancel</a>
                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md">Update</button>
                        </div>
                    </form>
                </div>
            </div>
         



        </div>
    </div>
@endsection

@extends('admin-panel.index')
@section('admin-panel')
    <div class="bg-gray-100 py-10 px-5">
        <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-full">
            <div class="container mx-auto relative">
                <!-- Header -->
                <div class="text-center mb-5">
                    <h1 class="text-3xl font-semibold text-center mb-6">School Management</h1>
                </div>

                @if (session('success'))
                    <div class="msg-hide text-left bg-green-200 my-3 p-2">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="text-right mb-4">
                    <button id="addSchoolBtn" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add School
                        Name</button>
                </div>

                <!-- Table Section -->
                <div class="mt-5">
                    <h2 class="text-xl font-bold text-gray-700 mb-4">School Details</h2>
                    <table id="schoolTable" class="table-auto w-full bg-white rounded shadow-md text-center">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-2">School Name</th>
                                <th class="p-2">Principal Name</th>
                                <th class="p-2">City</th>
                                <th class="p-2">District</th>
                                <th class="p-2">Contact</th>
                                <th class="p-2">Email</th>
                                <th class="p-2">Established</th>
                                <th class="p-2">Website</th>
                                <th class="p-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($allSchoolRecord))
                            {{-- {{ $allSchoolRecord }} --}}
                                @foreach ($allSchoolRecord as $schoolRecord)
                                    <tr>
                                        <td class="py-2">{{ $schoolRecord->school_name }}</td>
                                        <td class="py-2">{{ $schoolRecord->principal_name }}</td>
                                        <td class="py-2">{{ $schoolRecord->city_name }}</td>
                                        <td class="py-2">{{ $schoolRecord->district_name }}</td>
                                        <td class="py-2">{{ $schoolRecord->contact_no }}</td>
                                        <td class="py-2">{{ $schoolRecord->school_email }}</td>
                                        <td class="py-2">{{ $schoolRecord->established_year }}</td>
                                        <td class="py-2">{{ $schoolRecord->school_website }}</td>
                                        
                                        <td class="flex justify-center items-center text-center py-2">

                                            <button type="button" class="bg-green-500 text-white px-4 py-2 rounded-md m-1"
                                                id="showEditModel" onclick="openEditModel(this)" data-edit-uuid="{{ $schoolRecord->uuid }}"
                                                data-edit-schoolName="{{ $schoolRecord->school_name }}" data-edit-principalName="{{ $schoolRecord->principal_name }}" data-edit-city="{{ $schoolRecord->city_name }}" data-edit-district="{{ $schoolRecord->district_name }}" data-edit-contact="{{ $schoolRecord->contact_no }}" data-edit-email="{{ $schoolRecord->school_email }}" data-edit-established="{{ $schoolRecord->established_year }}" data-edit-website="{{ $schoolRecord->school_website }}">Edit</button>

                                            <form method="POST"
                                                action="{{ route('schoolDetailDelete', $schoolRecord->uuid) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                    class="bg-red-500 text-white px-4 py-2 rounded-md m-1"
                                                    id="showDeleteModel">Delete</button>
                                            </form>
                                            <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md m-1"
                                                onclick="openModal(this)"
                                                data-school-name="{{ $schoolRecord->school_name }}"
                                                data-principal-name="{{ $schoolRecord->principal_name }}"
                                                data-city="{{ $schoolRecord->city_name }}"
                                                data-district="{{ $schoolRecord->district_name }}"
                                                data-contact="{{ $schoolRecord->contact_no }}"
                                                data-email="{{ $schoolRecord->school_email }}"
                                                data-established="{{ $schoolRecord->established_year }}"
                                                data-website="{{ $schoolRecord->school_website }}">View</button>

                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="py-2 text-gray-500">No records found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>


            {{-- model for view button --}}
            <div id="viewModal"
                class="fixed inset-0 bg-gray-900 bg-opacity-50 backdrop-blur-sm flex items-center justify-center hidden">
                <div class="bg-white rounded shadow-lg w-full max-w-lg p-5 relative">
                    <button  class="absolute top-0 right-0 -mt-2 -mr-3 text-red px-4 py-2 rounded hover:text-red-500 text-xl font-bold"
                            onclick="closeModel()">X</button>
                    <h2 class="text-xl font-bold text-gray-700 mb-3">View School Details</h2>
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
                    <button  class="absolute top-0 right-0 -mt-2 -mr-3 text-red px-4 py-2 rounded hover:text-red-500 text-xl font-bold"
                    onclick="closeEditModel()">X</button>
                    <h2 class="text-xl font-bold text-gray-700 mb-3">Edit School Details</h2>
                    <div id="viewEditContent" class="text-left"></div>
                    <div class="text-right" style="margin-top:-40px">
                        <button  class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                            onclick="closeEditModel()">Close</button>
                    </div>
                </div>
            </div>


            <!-- Form Modal -->
            <div id="formModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-6 rounded shadow-lg w-full max-w-md relative">
                    <button type="button" id="closeModalSym"
                    class="absolute top-0 right-0 -mt-2 -mr-3 text-red px-4 py-2 rounded hover:text-red-500 text-xl font-bold">X</button>
                    <h2 class="text-xl font-bold mb-4">Add School Details</h2>
                    <form id="schoolForm" method="POST" action="{{ route('schoolDetailSubmit') }}">
                        @csrf
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="schoolName" class="block text-gray-700">School Name</label>
                                <input type="text" id="schoolName" name="schoolName" class="w-full p-2 border rounded"
                                    required>
                                @error('schoolName')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="principalName" class="block text-gray-700">Principal Name</label>
                                <input type="text" id="principalName" name="principalName"
                                    class="w-full p-2 border rounded" required>
                                @error('principalName')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="city" class="block text-gray-700">City</label>
                                <input type="text" id="city" name="city" class="w-full p-2 border rounded"
                                    required>
                                @error('city')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="district" class="block text-gray-700">District</label>
                                <input type="text" id="district" name="district" class="w-full p-2 border rounded"
                                    required>
                                @error('district')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="contactNumber" class="block text-gray-700">School Contact Number</label>
                                <input type="tel" id="contactNumber" name="contactNumber" maxlength="10"
                                    minlength="10" pattern="\d{10}" title="Please enter exactly 10 digits"
                                    class="w-full p-2 border rounded" required>
                                @error('contactNumber')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-gray-700">School Email</label>
                                <input type="email" id="email" name="email" class="w-full p-2 border rounded"
                                    required>
                                @error('email')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="establishedYear" class="block text-gray-700">Established Year</label>
                                <input type="number" id="establishedYear" name="establishedYear"
                                    class="w-full p-2 border rounded" min="1900" max="2099" required>
                                @error('establishedYear')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="website" class="block text-gray-700">School Website</label>
                                <input type="url" id="website" name="website" class="w-full p-2 border rounded">
                                @error('website')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-end gap-2">
                            <button type="button" id="closeModal"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal Controls
        const addSchoolBtn = document.getElementById('addSchoolBtn');
        const formModal = document.getElementById('formModal');
        const closeModal = document.getElementById('closeModal');

        addSchoolBtn.addEventListener('click', () => {
            formModal.classList.remove('hidden');
        });

        closeModal.addEventListener('click', () => {
            formModal.classList.add('hidden');
        }); 
         closeModalSym.addEventListener('click', () => {
            formModal.classList.add('hidden');
        });



        function openModal(a) {
            document.getElementById('viewModal').classList.remove('hidden');
            const viewSchoolName = a.getAttribute('data-school-name');
            const viewPrincipalName = a.getAttribute('data-principal-name');
            const viewCityName = a.getAttribute('data-city');
            const viewDistrictName = a.getAttribute('data-district');
            const viewContactNo = a.getAttribute('data-contact');
            const viewEmail = a.getAttribute('data-email');
            const viewEstablishedYear = a.getAttribute('data-established');
            const viewWebsite = a.getAttribute('data-website');
            document.querySelector('#viewContent').innerHTML = `
             <div class="flex justify-between">
                <div><strong>School Name :</strong></div>
                <div>${viewSchoolName}</div>
            </div>
             <div class="flex justify-between">
                <div><strong>Principal Name :</strong></div>
                <div>${viewPrincipalName}</div>
            </div>
             <div class="flex justify-between">
                <div><strong>City :</strong></div>
                <div>${viewCityName}</div>
            </div>
             <div class="flex justify-between">
                <div><strong>District :</strong></div>
                <div>${viewDistrictName}</div>
            </div>
             <div class="flex justify-between">
                <div><strong>Contact :</strong></div>
                <div>${viewContactNo}</div>
            </div>
             <div class="flex justify-between">
                <div><strong>Email :</strong></div>
                <div>${viewEmail}</div>
            </div>
             <div class="flex justify-between">
                <div><strong>Established :</strong></div>
                <div>${viewEstablishedYear}</div>
            </div>
             <div class="flex justify-between">
                <div><strong>Website :</strong></div>
                <div>${viewWebsite}</div>
            </div>
            `;
        }

        function closeModel() {
            document.getElementById('viewModal').classList.add('hidden');
        }

        function openEditModel(s){
            document.getElementById('viewEditModal').classList.remove('hidden');
            const editUuid = s.getAttribute('data-edit-uuid');
            const editSchoolName = s.getAttribute('data-edit-schoolName');
            const editPrincipalName = s.getAttribute('data-edit-principalName');
            const editCity = s.getAttribute('data-edit-city');
            const editDistrict = s.getAttribute('data-edit-district');
            const editContact = s.getAttribute('data-edit-contact');
            const editEmail = s.getAttribute('data-edit-email');
            const editEstablished = s.getAttribute('data-edit-established');
            const editWebsite = s.getAttribute('data-edit-website');
                document.querySelector('#viewEditContent').innerHTML = `
                    <form  method="POST" action="{{ route('schoolDetailUpdate') }}">
                        @method('PUT')
                        @csrf
                            <input type="hidden" name="schoolId" value="${editUuid}">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="schoolName" class="block text-gray-700">School Name</label>
                                <input type="text" id="schoolName" name="schoolName" class="w-full p-2 border rounded" value="${editSchoolName}"
                                    required>
                                @error('schoolName')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="principalName" class="block text-gray-700">Principal Name</label>
                                <input type="text" id="principalName" name="principalName"
                                    class="w-full p-2 border rounded" value="${editPrincipalName}" required>
                                @error('principalName')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="city" class="block text-gray-700">City</label>
                                <input type="text" id="city" name="city" class="w-full p-2 border rounded" value="${editCity}"
                                    required>
                                @error('city')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="district" class="block text-gray-700">District</label>
                                <input type="text" id="district" name="district" class="w-full p-2 border rounded"  value="${editDistrict}"
                                    required>
                                @error('district')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                             <div>
                                <label for="contactNumber" class="block text-gray-700">School Contact Number</label>
                                <input type="tel" class="form-control" id="mobile" name="contactNumber" required pattern="[0-9]{10}" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="${editContact}">
                              
                                @error('contactNumber')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-gray-700">School Email</label>
                                <input type="email" id="email" name="email" class="w-full p-2 border rounded" value="${editEmail}" 
                                    required>
                                @error('email')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="establishedYear" class="block text-gray-700">Established Year</label>
                                <input type="number" id="establishedYear" name="establishedYear"
                                    class="w-full p-2 border rounded" min="1900" max="2099" value="${editEstablished}" required>
                                @error('establishedYear')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="website" class="block text-gray-700">School Website</label>
                                <input type="url" id="website" name="website" class="w-full p-2 border rounded" value="${editWebsite}" >
                                @error('website')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="">
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                        </div>
                    </form>
                `;
        }


        function closeEditModel() {
            document.getElementById('viewEditModal').classList.add('hidden');
        }
    </script>
@endsection

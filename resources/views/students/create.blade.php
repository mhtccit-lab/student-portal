<x-app-layout>
    <div class="max-w-6xl mx-auto py-6">

        <h2 class="text-2xl font-bold mb-6">Create Student</h2>
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Important Notice --}}
        <div class="bg-yellow-100 border-t-4 border-yellow-500 rounded-b text-stone-900 px-4 py-4 mb-6 shadow-md" role="alert">
            <div class="flex">
              <div class="py-1">
                <svg class="fill-current h-6 w-6 text-yellow-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg>
            </div>
              <div>
                <p class="font-bold">Important</p>
                <p class="text-sm">Once the account is created, data cannot be modified or changed. Please ensure accurate information is entered for all fields in this form.</p>
              </div>
            </div>
        </div>

        <form method="POST"
              action="{{ route('students.store') }}"
              enctype="multipart/form-data"
              class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf

            {{-- Full Name English --}}
            <div>
                <label class="block mb-1">Full Name (English)</label>
                <input type="text" name="full_name_english"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                       value="{{ old('full_name_english') }}">
            </div>

            {{-- Full Name Bangla --}}
            <div>
                <label class="block mb-1">Full Name (Bangla)</label>
                <input type="text" name="full_name_bangla" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200" value="{{ old('full_name_bangla') }}">
            </div>

            {{-- Father Name --}}
            <div>
                <label class="block font-medium text-sm text-gray-700">Father Name</label>
                <input type="text" name="father_name" value="{{ old('father_name') }}" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200">
            </div>

            {{-- Mother Name --}}
            <div>
                <label class="block font-medium text-sm text-gray-700">Mother Name</label>
                <input type="text" name="mother_name" value="{{ old('mother_name') }}" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200">
            </div>

            {{-- Gender --}}
            <div>
                <label class="block mb-1">Gender</label>
                <select name="gender" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200">
                    <option value="">Select</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
            </div>

            {{-- Phone --}}
            <div>
                <label class="block mb-1">Phone</label>
                <input type="text" name="phone"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                       value="{{ old('phone') }}">
            </div>

            {{-- Email --}}
            <div>
                <label class="block mb-1">Email</label>
                <input type="email" name="email"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                       value="{{ old('email') }}">
            </div>

            {{-- Date of Birth --}}
            <div>
                <label class="block mb-1">Date of Birth</label>
                <input type="date" name="date_of_birth"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                       value="{{ old('date_of_birth') }}">
            </div>

            {{-- Current Address --}}
            <div class="md:col-span-2">
                <label class="block mb-1">Current Address</label>
                <textarea name="current_address"
                          class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                          rows="2">{{ old('current_address') }}</textarea>
            </div>

            {{-- Permanent Address --}}
            <div class="md:col-span-2">
                <label class="block mb-1">Permanent Address</label>
                <textarea name="permanent_address"
                          class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                          rows="2">{{ old('permanent_address') }}</textarea>
            </div>

            {{-- District --}}
            <div>
                <label class="block mb-1">District</label>
                <input name="district" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200" value="{{ old('district') }}">
            </div>

            {{-- Police Station --}}
            <div>
                <label class="block mb-1">Police Station</label>
                <input name="police_station" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200" value="{{ old('police_station') }}">
            </div>

            {{-- Postal Code --}}
            <div>
                <label class="block mb-1">Postal Code</label>
                <input name="postal_code" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200" value="{{ old('postal_code') }}">
            </div>

            {{-- Card Type --}}
            <div>
                <label class="block mb-1">Type of Card</label>
                <select name="types_of_card" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200">
                    <option value="passport" {{ old('types_of_card') == 'passport' ? 'selected' : '' }}>Passport</option>
                    <option value="nid" {{ old('types_of_card') == 'nid' ? 'selected' : '' }}>NID</option>
                    <option value="birth_certificate" {{ old('types_of_card') == 'birth_certificate' ? 'selected' : '' }}>Birth Certificate</option>
                    <option value="driving_license" {{ old('types_of_card') == 'driving_license' ? 'selected' : '' }}>Driving License</option>
                </select>
            </div>

            {{-- Card Number --}}
            <div>
                <label class="block mb-1">Card Number</label>
                <input name="card_number" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200" value="{{ old('card_number') }}">
            </div>

            {{-- Passport Expiry --}}
            <div>
                <label class="block mb-1">Expiry Date</label>
                <input type="date" name="passport_expiry_date"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200" value="{{ old('passport_expiry_date') }}">
            </div>

            {{-- Card File --}}
            <div>
                <label class="block mb-1">Card File</label>
                <input type="file" name="card_file"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200" value="{{ old('card_file') }}">
            </div>

            {{-- Photo --}}
            <div>
                <label class="block mb-1">Photo</label>
                <input type="file" name="photo"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200" value="{{ old('photo') }}">
            </div>

            {{-- Reference --}}
            <div>
                <label class="block mb-1">Reference Name</label>
                <input name="reference_name"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200" value="{{ old('reference_name') }}">
            </div>

            {{-- Status --}}
            <div>
                <label class="block mb-1">Status</label>
                <select name="status" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200">
                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            {{-- Actions --}}
            <div class="md:col-span-2 flex justify-end gap-3 mt-4">
                <a href="{{ route('students.index') }}"
                   class="px-4 py-2 border rounded">
                    Cancel
                </a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">
                    Save Student
                </button>
            </div>

        </form>
    </div>

</x-app-layout>

<x-app-layout>
    <div class="max-w-6xl mx-auto py-6">

        <h2 class="text-2xl font-bold mb-6">Edit Student</h2>

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 mb-6 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ route('students.update', $student) }}"
              enctype="multipart/form-data"
              class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf
            @method('PUT')

            {{-- Full Name English --}}
            <div>
                <label class="block mb-1">Full Name (English)</label>
                <input name="full_name_english"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                       value="{{ old('full_name_english', $student->full_name_english) }}">
            </div>

            {{-- Full Name Bangla --}}
            <div>
                <label class="block mb-1">Full Name (Bangla)</label>
                <input name="full_name_bangla"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                       value="{{ old('full_name_bangla', $student->full_name_bangla) }}">
            </div>

            {{-- Father Name --}}
            <div>
                <label class="block font-medium text-sm text-gray-700">Father Name</label>
                <input type="text" name="father_name" value="{{ old('father_name', $student->father_name) }}" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200">
            </div>

            {{-- Mother Name --}}
            <div>
                <label class="block font-medium text-sm text-gray-700">Mother Name</label>
                <input type="text" name="mother_name" value="{{ old('mother_name', $student->mother_name) }}" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200">
            </div>

            {{-- Gender --}}
            <div>
                <label class="block mb-1">Gender</label>
                <select name="gender" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200">
                    <option value="Male" {{ old('gender',$student->gender)=='Male'?'selected':'' }}>Male</option>
                    <option value="Female" {{ old('gender',$student->gender)=='Female'?'selected':'' }}>Female</option>
                </select>
            </div>

            {{-- Phone --}}
            <div>
                <label class="block mb-1">Phone</label>
                <input name="phone"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                       value="{{ old('phone', $student->phone) }}">
            </div>

            {{-- Email --}}
            <div>
                <label class="block mb-1">Email</label>
                <input type="email"
                       name="email"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                       value="{{ old('email', $student->email) }}">
            </div>

            {{-- Date of Birth --}}
            <div>
                <label class="block mb-1">Date of Birth</label>
                <input type="date"
                       name="date_of_birth"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                       value="{{ old('date_of_birth', $student->date_of_birth) }}">
            </div>

            {{-- Current Address --}}
            <div class="md:col-span-2">
                <label class="block mb-1">Current Address</label>
                <textarea name="current_address"
                          class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                          rows="2">{{ old('current_address', $student->current_address) }}</textarea>
            </div>

            {{-- Permanent Address --}}
            <div class="md:col-span-2">
                <label class="block mb-1">Permanent Address</label>
                <textarea name="permanent_address"
                          class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                          rows="2">{{ old('permanent_address', $student->permanent_address) }}</textarea>
            </div>

            {{-- District --}}
            <div>
                <label class="block mb-1">District</label>
                <input name="district"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                       value="{{ old('district', $student->district) }}">
            </div>

            {{-- Police Station --}}
            <div>
                <label class="block mb-1">Police Station</label>
                <input name="police_station"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                       value="{{ old('police_station', $student->police_station) }}">
            </div>

            {{-- Postal Code --}}
            <div>
                <label class="block mb-1">Postal Code</label>
                <input name="postal_code"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                       value="{{ old('postal_code', $student->postal_code) }}">
            </div>

            {{-- Card Type --}}
            <div>
                <label class="block mb-1">Type of Card</label>
                <select name="types_of_card" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200">
                    <option value="passport" {{ old('types_of_card',$student->types_of_card)=='passport'?'selected':'' }}>Passport</option>
                    <option value="nid" {{ old('types_of_card',$student->types_of_card)=='nid'?'selected':'' }}>NID</option>
                    <option value="birth_certificate" {{ old('types_of_card',$student->types_of_card)=='birth_certificate'?'selected':'' }}>Birth Certificate</option>
                    <option value="driving_license" {{ old('types_of_card',$student->types_of_card)=='driving_license'?'selected':'' }}>Driving License</option>
                </select>
            </div>

            {{-- Card Number --}}
            <div>
                <label class="block mb-1">Card Number</label>
                <input name="card_number"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                       value="{{ old('card_number', $student->card_number) }}">
            </div>

            {{-- Passport Expiry --}}
            <div>
                <label class="block mb-1">Passport Expiry Date</label>
                <input type="date"
                       name="passport_expiry_date"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                       value="{{ old('passport_expiry_date', $student->passport_expiry_date) }}">
            </div>

            {{-- Card File --}}
            <div>
                <label class="block mb-1">Card File</label>
                <input type="file" name="card_file" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200">
                @if($student->card_file)
                    <a href="{{ asset('storage/'.$student->card_file) }}"
                       class="text-blue-600 text-sm">View existing file</a>
                @endif
            </div>

            {{-- Photo --}}
            <div>
                <label class="block mb-1">Photo</label>
                <input type="file" name="photo" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200">
                @if($student->photo)
                    <img src="{{ asset('storage/'.$student->photo) }}"
                         class="h-20 mt-2 rounded">
                @endif
            </div>

            {{-- Reference --}}
            <div>
                <label class="block mb-1">Reference Name</label>
                <input name="reference_name"
                       class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                       value="{{ old('reference_name', $student->reference_name) }}">
            </div>

            {{-- Status --}}
            <div>
                <label class="block mb-1">Status</label>
                <select name="status" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200">
                    <option value="active" {{ $student->status=='active'?'selected':'' }}>Active</option>
                    <option value="inactive" {{ $student->status=='inactive'?'selected':'' }}>Inactive</option>

                </select>
            </div>

            {{-- Actions --}}
            <div class="md:col-span-2 flex justify-end gap-3 mt-4">
                <a href="{{ route('students.index') }}"
                   class="px-4 py-2 border rounded">
                    Cancel
                </a>
                <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded">
                    Update Student
                </button>
            </div>

        </form>
    </div>

    {{-- Auto course duration & fee --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const courseSelect = document.getElementById('course_id');

            if (!courseSelect) return;

            courseSelect.addEventListener('change', function () {
                fetch(`/courses/${this.value}/info`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('course_duration').value = data.duration;
                        document.getElementById('course_fee').value = data.price;
                    });
            });
        });
    </script>
</x-app-layout>

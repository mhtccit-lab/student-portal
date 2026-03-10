<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Edit Enrollment
        </h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto">
        <form method="POST"
              action="{{ route('enrollments.update', $enrollment->id) }}"
              class="bg-white shadow rounded-lg p-6 space-y-6">
            @csrf
            @method('PUT')

            {{-- Student --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Student</label>
                <select name="student_id" required
                        class="mt-1 w-full rounded-md border-gray-300">
                    @foreach($students as $student)
                        <option value="{{ $student->id }}"
                            @selected($enrollment->student_id == $student->id)>
                            {{ $student->full_name_english }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Institute --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Institute</label>
                <select name="institute_id" required
                        class="mt-1 w-full rounded-md border-gray-300">
                    @foreach($institutes as $institute)
                        <option value="{{ $institute->id }}"
                            @selected($enrollment->institute_id == $institute->id)>
                            {{ $institute->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Trade --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Trade</label>
                <select name="trade_id" required
                        class="mt-1 w-full rounded-md border-gray-300">
                    @foreach($trades as $trade)
                        <option value="{{ $trade->id }}"
                            @selected($enrollment->trade_id == $trade->id)>
                            {{ $trade->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Course --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Course</label>
                <select name="course_id" required
                        class="mt-1 w-full rounded-md border-gray-300">
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}"
                            @selected($enrollment->course_id == $course->id)>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="grid md:grid-cols-5 gap-4">

                {{-- Course Type --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Course Type</label>
                    <select name="course_type" id="course_type" required
                            class="mt-1 w-full rounded-md border-gray-300">
                        <option value="NSDA" @selected($enrollment->course_type === 'NSDA')>
                            NSDA
                        </option>
                        <option value="Takamol" @selected($enrollment->course_type === 'Takamol')>
                            Takamol
                        </option>
                    </select>
                </div>

                {{-- Course Fee --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Course Fee</label>
                    <input name="course_fee"
                        id="course_fee"
                        readonly
                        class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                        value="{{ old('course_fee', $student->course_fee) }}">
                </div>

                {{-- Course Duration --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Course Duration</label>
                    <input name="course_duration"
                        id="course_duration"
                        readonly
                        class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                        value="{{ old('course_duration', $student->course_duration) }}">
                </div>

                {{-- Amount Paid --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Amount Paid</label>
                    <input placeholder="Enter Amount Paid" name="amount_paid" id="amount_paid" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200" value="{{ old('amount_paid', $enrollment->amount_paid) }}">
                </div>

                {{-- Amount Due --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Amount Due</label>
                    <input placeholder="Enter Amount Due" name="amount_due" id="amount_due" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200" readonly value="{{ old('amount_due', $enrollment->amount_due) }}">
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-4">
                {{-- Amount Receiver --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Amount Receiver Name</label>
                    <input name="amount_receiver_name"
                        class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200"
                        value="{{ old('amount_receiver_name', $student->amount_receiver_name) }}"
                        placeholder="Enter Receiver Name"
                        >
                </div>

                {{-- Enrollment Date --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Enrollment Date</label>
                    <input placeholder="Enter Enrollment Date" type="date" name="enroll_date" value="{{ old('enroll_date', date('Y-m-d', strtotime($enrollment->enroll_date))) }}" required
                        class="mt-1 w-full rounded-md border-gray-300">
                </div>


                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status"
                            class="mt-1 w-full rounded-md border-gray-300">
                        <option value="enrolled" @selected($enrollment->status === 'enrolled')>
                            Enrolled
                        </option>
                        <option value="completed" @selected($enrollment->status === 'completed')>
                            Completed
                        </option>
                        <option value="cancelled" @selected($enrollment->status === 'cancelled')>
                            Cancelled
                        </option>
                    </select>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('enrollments.index') }}"
                class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">
                    Cancel
                </a>
                <button type="submit"
                        class="px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Update Enrollment
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

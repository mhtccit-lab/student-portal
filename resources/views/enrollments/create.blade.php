<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            New Enrollment
        </h2>
    </x-slot>

    <div class="py-8 max-w-5xl mx-auto">
        @if ($errors->any())
            <div class="mb-4 rounded bg-red-50 p-4 text-red-700">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('enrollments.store') }}"
              class="bg-white shadow rounded-lg p-6 space-y-6">
            @csrf

            {{-- Student --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Student</label>
                <select name="student_id" class="w-full rounded border p-2">
                    <option value="">-- Select Student --</option>

                    @foreach ($students as $student)
                        <option
                            value="{{ $student->id }}"
                            @disabled($enrolledStudentIds->contains($student->id))
                        >
                            {{ $student->full_name_english }}
                            @if($enrolledStudentIds->contains($student->id))
                                (Already Enrolled)
                            @endif
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
                        <option value="{{ $institute->id }}">
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
                        <option value="{{ $trade->id }}">
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
                        <option value="{{ $course->id }}">
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Enrollment Date --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Enrollment Date</label>
                <input type="date" name="enroll_date" required
                       class="mt-1 w-full rounded-md border-gray-300">
            </div>            

            {{-- Status --}}
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status"
                        class="mt-1 w-full rounded-md border-gray-300">
                    <option value="enrolled">Enrolled</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('enrollments.index') }}"
                   class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">
                    Cancel
                </a>
                <button type="submit"
                        class="px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Save Enrollment
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
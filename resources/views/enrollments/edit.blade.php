<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Edit Enrollment
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <form method="POST"
                      action="{{ route('enrollments.update', $enrollment->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Student --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Student
                        </label>
                        <select name="student_id"
                                class="mt-1 w-full border-gray-300 rounded-md">
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}"
                                    {{ $student->id == $enrollment->student_id ? 'selected' : '' }}>
                                    {{ $student->full_name_english }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Institute --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Institute
                        </label>
                        <select name="institute_id"
                                class="mt-1 w-full border-gray-300 rounded-md">
                            @foreach ($institutes as $institute)
                                <option value="{{ $institute->id }}"
                                    {{ $institute->id == $enrollment->institute_id ? 'selected' : '' }}>
                                    {{ $institute->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Trade --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Trade
                        </label>
                        <select name="trade_id"
                                class="mt-1 w-full border-gray-300 rounded-md">
                            @foreach ($trades as $trade)
                                <option value="{{ $trade->id }}"
                                    {{ $trade->id == $enrollment->trade_id ? 'selected' : '' }}>
                                    {{ $trade->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Course --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">
                            Course
                        </label>
                        <select name="course_id"
                                class="mt-1 w-full border-gray-300 rounded-md">
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ $course->id == $enrollment->course_id ? 'selected' : '' }}>
                                    {{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Status --}}
                    {{-- <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">
                            Status
                        </label>
                        <select name="status"
                                class="mt-1 w-full border-gray-300 rounded-md">
                            <option value="active"
                                {{ $enrollment->status == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive"
                                {{ $enrollment->status == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div> --}}

                    {{-- Status --}}
                    <div class="mb-6">
                         <label class="block mb-1">Status</label>
                         <select name="status" class="w-full border p-2">
                              <option value="enrolled"
                                {{ $enrollment->status == 'enrolled' ? 'selected' : '' }}>
                                   Enrolled</option>
                              <option value="completed"
                                {{ $enrollment->status == 'completed' ? 'selected' : '' }}>
                                   Completed</option>
                              <option value="cancelled"
                                {{ $enrollment->status == 'cancelled' ? 'selected' : '' }}>
                                   Cancelled</option>
                         </select>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-end gap-3">
                        <a href="{{ route('enrollments.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded-md">
                            Cancel
                        </a>

                        <button type="submit"
                                class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                            Update Enrollment
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>

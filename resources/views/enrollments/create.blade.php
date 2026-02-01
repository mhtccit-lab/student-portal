<x-app-layout>
<div class="max-w-4xl mx-auto py-6">
    <h2 class="text-2xl font-bold mb-6">New Enrollment</h2>
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('enrollments.store') }}" method="POST">
        @csrf

        {{-- Student --}}
        <div>
            <label class="block mb-1">Student</label>
            <select name="student_id" class="w-full border p-2">
                @foreach($students as $student)
                    <option value="{{ $student->id }}">
                        {{ $student->full_name_english }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Institute --}}
        <div>
            <label class="block mb-1">Institute</label>
            <select name="institute_id" class="w-full border p-2">
                @foreach($institutes as $institute)
                    <option value="{{ $institute->id }}">
                        {{ $institute->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Trade --}}
        <div>
            <label class="block mb-1">Trade</label>
            <select name="trade_id" class="w-full border p-2">
                @foreach($trades as $trade)
                    <option value="{{ $trade->id }}">
                        {{ $trade->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Course --}}
        <div>
            <label class="block mb-1">Course</label>
            <select name="course_id" class="w-full border p-2">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Date --}}
        <div>
            <label class="block mb-1">Enrollment Date</label>
            <input type="date" name="enroll_date"
                class="w-full border p-2">
        </div>

        {{-- Status --}}
        <div>
            <label class="block mb-1">Status</label>
            <select name="status" class="w-full border p-2">
                <option value="enrolled">Enrolled</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <div class="md:col-span-2 flex justify-end mt-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded">
                Enroll Student
            </button>
        </div>
    </form>
</div>
</x-app-layout>

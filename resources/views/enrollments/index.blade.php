<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Student Enrollments
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    Enrollment List
                </h1>

                <a href="{{ route('enrollments.create') }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded-md
                          hover:bg-indigo-700 transition">
                    + New Enrollment
                </a>
            </div>
            
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Search Filter --}}
            <form method="GET" action="{{ route('enrollments.index') }}"
                class="bg-white p-4 rounded-lg shadow mb-6 grid grid-cols-1 md:grid-cols-6 gap-4">

                <!-- Student -->
                <select name="student_id" class="border rounded-lg px-3 py-2">
                    <option value="">All Students</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}"
                            {{ request('student_id') == $student->id ? 'selected' : '' }}>
                            {{ $student->full_name_english }}
                        </option>
                    @endforeach
                </select>

                <!-- Institute -->
                <select name="institute_id" id="institute" class="border rounded-lg px-3 py-2">
                    <option value="">All Institutes</option>
                    @foreach($institutes as $institute)
                        <option value="{{ $institute->id }}">
                            {{ $institute->name }}
                        </option>
                    @endforeach
                </select>

                {{-- Trade --}}
                <select name="trade_id" id="trade" class="border rounded-lg px-3 py-2">
                    <option value="">All Trades</option>
                    @foreach($trades as $trade)
                        <option value="{{ $trade->id }}"
                            {{ request('trade_id') == $trade->id ? 'selected' : '' }}>
                            {{ $trade->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Course -->
                <select name="course_id" id="course" class="border rounded-lg px-3 py-2">
                    <option value="">All Courses</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}"
                            {{ request('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Date -->
                <input type="date"
                    name="enroll_date"
                    value="{{ request('enroll_date') }}"
                    class="border rounded-lg px-3 py-2">

                <!-- Status -->
                <select name="status" class="border rounded-lg px-3 py-2">
                    <option value="">All Status</option>
                    <option value="enrolled" {{ request('status') == 'enrolled' ? 'selected' : '' }}>Enrolled</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>

                <!-- Buttons -->
                <div class="md:col-span-6 flex gap-3 mt-2">
                    <button type="submit"
                            class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                        Filter
                    </button>

                    <a href="{{ route('enrollments.index') }}"
                    class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600">
                        Reset
                    </a>
                </div>
            </form>

            {{-- Table --}}
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">#</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Student</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Institute</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Trade</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Course</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Date</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 uppercase">Status</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-600 uppercase">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($enrollments as $enrollment)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm">
                                        {{ $loop->iteration }}
                                    </td>

                                    <td class="px-4 py-3 text-sm font-medium text-gray-800">
                                        @if($enrollment->student)
                                            {{ $enrollment->student->full_name_english }}
                                        @else
                                            <span class="text-red-500 text-sm">Student deleted</span>
                                        @endif
                                        {{-- {{ $enrollment->student->full_name_english }} --}}
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        {{ $enrollment->institute?->name ?? 'N/A' }}
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        {{ $enrollment->trade?->name ?? 'N/A' }}
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        {{ $enrollment->course?->name ?? 'N/A' }}
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        {{ $enrollment->created_at?->format('d M Y') ?? 'N/A' }}
                                    </td>

                                    {{-- Status Badge --}}
                                    <td class="px-4 py-3 text-center">
                                        @if($enrollment->status === 'enrolled' )
                                            <span class="px-3 py-1 text-xs font-semibold
                                                bg-green-100 text-green-700 rounded-full">
                                                Enrolled
                                            </span>
                                        @elseif($enrollment->status === 'completed')
                                            <span class="px-3 py-1 text-xs font-semibold
                                                bg-blue-100 text-blue-700 rounded-full">
                                                Completed
                                            </span>
                                        @elseif($enrollment->status === 'cancelled')
                                            <span class="px-3 py-1 text-xs font-semibold
                                                bg-red-100 text-red-700 rounded-full">
                                                Cancelled
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-4 py-3 text-center space-x-2">
                                        <a href="{{ route('enrollments.edit', $enrollment->id) }}"
                                           class="text-indigo-600 hover:text-indigo-900 text-sm">
                                            Edit
                                        </a>

                                        {{-- <form method="POST"
                                            action="{{ route('enrollments.destroy', $enrollment->id) }}"
                                            class="delete-form inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button"
                                                    onclick="confirmDelete(this)"
                                                    class="text-red-600 hover:text-red-800">
                                                Delete
                                            </button>
                                        </form> --}}
                                        <form action="{{ route('enrollments.destroy', $enrollment->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this enrollment?');"
                                            class="delete-form inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button"
                                                    onclick="confirmDelete(this)"
                                                    class="text-red-600 hover:text-red-800 font-medium">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                                        No enrollments found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="px-4 py-3 bg-gray-50">
                    {{ $enrollments->links() }}
                </div>
            </div>

        </div>
    </div>
    <script>
        document.getElementById('institute').addEventListener('change', function() {

            let instituteId = this.value;
            let tradeSelect = document.getElementById('trade');
            let courseSelect = document.getElementById('course');

            tradeSelect.innerHTML = '<option value="">Loading...</option>';
            courseSelect.innerHTML = '<option value="">All Courses</option>';

            if (instituteId) {
                fetch('/get-trades/' + instituteId)
                    .then(response => response.json())
                    .then(data => {

                        tradeSelect.innerHTML = '<option value="">All Trades</option>';

                        data.forEach(trade => {
                            tradeSelect.innerHTML +=
                                `<option value="${trade.id}">${trade.name}</option>`;
                        });
                    });
            } else {
                tradeSelect.innerHTML = '<option value="">All Trades</option>';
            }
        });

        document.getElementById('trade').addEventListener('change', function() {

            let tradeId = this.value;
            let courseSelect = document.getElementById('course');

            courseSelect.innerHTML = '<option value="">Loading...</option>';

            if (tradeId) {
                fetch('/get-courses/' + tradeId)
                    .then(response => response.json())
                    .then(data => {

                        courseSelect.innerHTML = '<option value="">All Courses</option>';

                        data.forEach(course => {
                            courseSelect.innerHTML +=
                                `<option value="${course.id}">${course.name}</option>`;
                        });
                    });
            } else {
                courseSelect.innerHTML = '<option value="">All Courses</option>';
            }
        });
    </script>
</x-app-layout>

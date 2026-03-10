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
                <select name="institute_id" id="institute" required
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
                <select name="trade_id" id="trade" required
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
                <select name="course_id" id="course" required
                        class="mt-1 w-full rounded-md border-gray-300">
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">
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
                        <option value="NSDA">NSDA</option>
                        <option value="Takamol">Takamol</option>
                    </select>
                </div>

                {{-- Course Fee --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Course Fee</label>
                    <input placeholder="Auto-calculated based on course and type" name="course_fee" id="course_fee" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200" readonly>

                </div>

                {{-- Course Duration --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Course Duration</label>
                    <input placeholder="Auto-calculated based on course and type" name="course_duration" id="course_duration" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200" readonly>
                </div>

                {{-- Amount Paid --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Amount Paid</label>
                    <input placeholder="Enter Amount Paid" name="amount_paid" id="amount_paid" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200">
                </div>

                {{-- Amount Due --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Amount Due</label>
                    <input placeholder="Enter Amount Due" name="amount_due" id="amount_due" class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200" readonly>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-4">
                {{-- Amount Receiver --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Amount Receiver Name</label>
                    <input placeholder="Enter Receiver Name" name="amount_receiver_name"
                        class="w-full mt-1 rounded border-gray-300 focus:ring focus:ring-blue-200" value="{{ old('amount_receiver_name') }}">
                </div>

                {{-- Enrollment Date --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700">Enrollment Date</label>
                    <input placeholder="Enter Enrollment Date" type="date" name="enroll_date" required
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

    <script>
      document.getElementById('course').addEventListener('change', function () {
          const courseId = this.value;

          if (!courseId) {
              document.getElementById('course_duration').value = '';
              document.getElementById('course_fee').value = '';
              return;
          }

          fetch(`/courses/${courseId}/info`)
              .then(response => response.json())
              .then(data => {
                  document.getElementById('course_duration').value = data.duration;
                  document.getElementById('course_fee').value = data.price;
              })
              .catch(error => {
                  console.error('Error fetching course info:', error);
              });
      });
    </script>
</x-app-layout>

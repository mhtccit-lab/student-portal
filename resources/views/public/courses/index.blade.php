<div class="max-w-7xl mx-auto px-6 py-12">
    <h1 class="text-3xl font-bold text-center mb-10">
        Our Professional Courses
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach ($courses as $course)
            <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-6">
                <h2 class="text-xl font-semibold mb-2">
                    {{ $course->name }}
                </h2>

                <p class="text-gray-600 mb-2">
                    Duration: {{ $course->duration }}
                </p>

                <p class="text-gray-800 font-bold mb-4">
                    Fee: ৳ {{ number_format($course->price) }}
                </p>

                <a href="{{ route('course.order', $course->id) }}"
                   class="block text-center bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                    Order Course
                </a>
            </div>
        @endforeach
    </div>
</div>

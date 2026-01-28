<x-app-layout>
    <div class="max-w-7xl mx-auto py-6">
        <div class="flex justify-between mb-4">
            <h2 class="text-xl font-bold">Courses</h2>
            <a href="{{ route('courses.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
               + Add Course
            </a>
        </div>

        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2 border">Trade</th>
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Duration</th>
                    <th class="p-2 border">Price</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr>
                    <td class="p-2 border">{{ $course->trade->name }}</td>
                    <td class="p-2 border">{{ $course->name }}</td>
                    <td class="p-2 border">{{ $course->duration }}</td>
                    <td class="p-2 border">{{ $course->price }}</td>
                    <td class="p-2 border">{{ ucfirst($course->status) }}</td>
                    <td class="p-2 border">
                        <a href="{{ route('courses.edit', $course) }}"
                           class="text-blue-600">Edit</a>
                        <form action="{{ route('courses.destroy', $course) }}"
                              method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600"
                                    onclick="return confirm('Delete this course?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $courses->links() }}
        </div>
    </div>
</x-app-layout>

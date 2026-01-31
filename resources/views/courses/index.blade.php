<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Courses
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    Course List
                </h1>

                <a href="{{ route('courses.create') }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded-md
                          hover:bg-indigo-700 transition">
                    + Add Course
                </a>
            </div>
            
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
        {{-- Table --}}
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
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
                    <tbody class="divide-y divide-gray-200">
                        @foreach($courses as $course)
                        <tr>
                            <td class="p-2 border">{{ $course->trade->name }}</td>
                            <td class="p-2 border">{{ $course->name }}</td>
                            <td class="p-2 border">{{ $course->duration }}</td>
                            <td class="p-2 border">{{ $course->price }}</td>
                            <td class="p-2 border">
                                <span class="px-2 py-1 text-sm rounded
                                    {{ $course->status == 'active' ? 'bg-green-200' : 'bg-red-200' }}">
                                    {{ ucfirst($course->status) }}
                                </span>
                            </td>
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
            </div>
            <div class="px-4 py-3 bg-gray-50">
                {{ $courses->links() }}
            </div>
        </div>        
    </div>
</x-app-layout>

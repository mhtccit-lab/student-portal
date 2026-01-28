<x-app-layout>
<div class="max-w-7xl mx-auto py-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">Students</h2>
        <a href="{{ route('students.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
           + Add Student
        </a>
    </div>

    <table class="w-full border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border p-2">Name</th>
                <th class="border p-2">Institute</th>
                <th class="border p-2">Course</th>
                <th class="border p-2">Phone</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td class="border p-2">{{ $student->full_name_english }}</td>
                <td class="border p-2">{{ $student->institute->name }}</td>
                <td class="border p-2">{{ $student->course->name }}</td>
                <td class="border p-2">{{ $student->phone }}</td>
                <td class="border p-2">{{ ucfirst($student->status) }}</td>
                <td class="border p-2">
                    <a href="{{ route('students.edit',$student) }}" class="text-blue-600">Edit</a>
                    <form method="POST" action="{{ route('students.destroy',$student) }}" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-600"
                          onclick="return confirm('Delete student?')">
                          Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $students->links() }}
</div>
</x-app-layout>

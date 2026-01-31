<x-app-layout>
<div class="max-w-7xl mx-auto py-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">Students</h2>
        <a href="{{ route('students.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
           + Add Student
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border">
        <thead class="p-4 bg-red-50 hover:bg-red-100 rounded shadow text-center">
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
                <td class="p-2 border">
                    <span class="px-2 py-1 text-sm rounded
                        {{ $student->status == 'active' ? 'bg-green-200' : 'bg-red-200' }}">
                        {{ ucfirst($student->status) }}
                    </span>
                </td>
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

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Students
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    Student List
                </h1>

                <a href="{{ route('students.create') }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded-md
                          hover:bg-indigo-700 transition">
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

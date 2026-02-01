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

            {{-- Table --}}
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">#</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Name</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Institute</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Course</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Phone</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse($students as $student)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-800">{{ $student->full_name_english }}</td>
                                <td class="px-4 py-3 text-sm">{{ $student->institute->name }}</td>
                                <td class="px-4 py-3 text-sm">{{ $student->course->name }}</td>
                                <td class="px-4 py-3 text-sm">{{ $student->phone }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2 py-1 text-sm rounded
                                        {{ $student->status == 'active' ? 'bg-green-200' : 'bg-red-200' }}">
                                        {{ ucfirst($student->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('students.edit',$student) }}" class="text-blue-600">Edit</a>
                                    <form method="POST"
                                        action="{{ route('students.destroy', $student->id) }}"
                                        class="delete-form inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                                onclick="confirmDelete(this)"
                                                class="text-red-600 hover:text-red-800">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-4 py-6 text-center text-gray-500">
                                    No institutes found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="px-4 py-3 bg-gray-50">
                    {{ $students->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

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
                                        {{ $enrollment->student->full_name_english }}
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        {{ $enrollment->institute->name }}
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        {{ $enrollment->trade->name }}
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        {{ $enrollment->course->name }}
                                    </td>

                                    <td class="px-4 py-3 text-sm">
                                        {{ $enrollment->created_at->format('d M Y') }}
                                    </td>

                                    {{-- Status Badge --}}
                                    <td class="px-4 py-3 text-center">
                                        @if($enrollment->status === 'enrolled')
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

                                        <form action="{{ route('enrollments.destroy', $enrollment->id) }}"
                                              method="POST"
                                              class="inline-block"
                                              onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="text-red-600 hover:text-red-900 text-sm">
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
</x-app-layout>

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

            {{-- Filters --}}
            <form method="GET" action="{{ route('students.index') }}" class="bg-white p-4 rounded-lg shadow mb-6 grid grid-cols-1 md:grid-cols-5 gap-4">

                <input type="text"
                    name="name"
                    value="{{ request('name') }}"
                    placeholder="Search by Name"
                    class="border rounded-lg px-3 py-2">

                <input type="text"
                    name="phone"
                    value="{{ request('phone') }}"
                    placeholder="Search by Phone"
                    class="border rounded-lg px-3 py-2">


                <select name="status" class="border rounded-lg px-3 py-2">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status')=='active'?'selected':'' }}>Active</option>
                    <option value="inactive" {{ request('status')=='inactive'?'selected':'' }}>Inactive</option>
                </select>

                <div class="md:col-span-5 flex gap-3">
                    <button class="bg-blue-600 text-white px-5 py-2 rounded-lg">
                        Filter
                    </button>

                    <a href="{{ route('students.index') }}"
                    class="bg-gray-500 text-white px-5 py-2 rounded-lg">
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
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Name</th>
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
                                <td class="px-4 py-3 text-sm">{{ $student->phone }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2 py-1 text-sm rounded {{ $student->status == 'active' ? 'bg-green-200' : 'bg-red-200' }}">
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
                                    No Student found.
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

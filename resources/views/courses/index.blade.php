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



        {{-- Search Filter --}}
        <form method="GET" action="{{ route('courses.index') }}" class="mb-6">
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                
                <!-- Trade -->
                <select name="trade_id"
                        class="rounded border-gray-300 focus:ring focus:ring-blue-200">
                    <option value="">All Trades</option>
                    @foreach ($trades as $trade)
                        <option value="{{ $trade->id }}"
                            {{ request('trade_id') == $trade->id ? 'selected' : '' }}>
                            {{ $trade->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Min Price -->
                <input type="number"
                    name="min_price"
                    placeholder="Min Price"
                    value="{{ request('min_price') }}"
                    class="rounded border-gray-300 focus:ring focus:ring-blue-200">

                <!-- Max Price -->
                <input type="number"
                    name="max_price"
                    placeholder="Max Price"
                    value="{{ request('max_price') }}"
                    class="rounded border-gray-300 focus:ring focus:ring-blue-200">

                <!-- Duration -->
                <input type="text"
                    name="duration"
                    placeholder="Duration (e.g. 3 months)"
                    value="{{ request('duration') }}"
                    class="rounded border-gray-300 focus:ring focus:ring-blue-200">

                <!-- Status -->
                <select name="status"
                        class="rounded border-gray-300 focus:ring focus:ring-blue-200">
                    <option value="">All Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>

                <!-- Buttons -->
                <div class="flex gap-2">
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition w-full">
                        Filter
                    </button>

                    <a href="{{ route('courses.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition w-full text-center">
                        Reset
                    </a>
                </div>

            </div>
        </form>

        {{-- Table --}}
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">#</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Trade</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Course Name</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Duration</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Price</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($courses as $course)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-sm">{{ $course->trade->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm">{{ $course->name }}</td>
                            <td class="px-4 py-3 text-sm">{{ $course->duration }}</td>
                            <td class="px-4 py-3 text-sm">{{ $course->price }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 text-sm rounded
                                    {{ $course->status == 'active' ? 'bg-green-200' : 'bg-red-200' }}">
                                    {{ ucfirst($course->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <a href="{{ route('courses.edit', $course) }}"
                                class="text-blue-600">Edit</a>
                                <form method="POST"
                                    action="{{ route('courses.destroy', $course->id) }}"
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
            <div class="px-4 py-3 bg-gray-50">
                {{ $courses->links() }}
            </div>
        </div> 
               
    </div>
</x-app-layout>

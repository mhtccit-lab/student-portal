<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Institutes
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    Institute List
                </h1>

                <a href="{{ route('institutes.create') }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded-md
                          hover:bg-indigo-700 transition">
                    + Add Institute
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
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Code</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse($institutes as $institute)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm">{{ $institute->name }}</td>
                                <td class="px-4 py-3 text-sm">{{ $institute->code }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2 py-1 text-sm rounded
                                        {{ $institute->status == 'active' ? 'bg-green-200' : 'bg-red-200' }}">
                                        {{ ucfirst($institute->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm space-x-2">
                                    <a href="{{ route('institutes.edit', $institute) }}"
                                    class="text-blue-600">Edit</a>

                                    <form action="{{ route('institutes.destroy', $institute) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Delete this institute?')"
                                                class="text-red-600">
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
                    {{ $institutes->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
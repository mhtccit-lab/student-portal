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
        <table class="w-full border border-gray-200">
            <thead class="p-4 bg-blue-50 hover:bg-blue-100 rounded shadow text-center">
                <tr>
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Code</th>
                    <th class="p-2 border">Status</th>
                    <th class="p-2 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($institutes as $institute)
                <tr>
                    <td class="p-2 border">{{ $institute->name }}</td>
                    <td class="p-2 border">{{ $institute->code }}</td>
                    <td class="p-2 border">
                        <span class="px-2 py-1 text-sm rounded
                            {{ $institute->status == 'active' ? 'bg-green-200' : 'bg-red-200' }}">
                            {{ ucfirst($institute->status) }}
                        </span>
                    </td>
                    <td class="p-2 border space-x-2">
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
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $institutes->links() }}
        </div>
    </div>
</x-app-layout>
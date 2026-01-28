<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">

        <div class="flex justify-between mb-4">
            <h2 class="text-xl font-bold">Institutes</h2>
            <a href="{{ route('institutes.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded">
                + Add Institute
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border border-gray-200">
            <thead class="bg-gray-100">
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
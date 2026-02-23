<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Trades
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    Trade List
                </h1>

                <a href="{{ route('trades.create') }}"
                   class="px-4 py-2 bg-indigo-600 text-white rounded-md
                          hover:bg-indigo-700 transition">
                    + Add Trade
                </a>
            </div>
            
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Search Filter --}}
            <form method="GET" action="{{ route('trades.index') }}" class="mb-6">
                <div class="flex items-center gap-4">

                    <select name="institute_id"
                            class="rounded border-gray-300 focus:ring focus:ring-blue-200">

                        <option value="">All Institutes</option>

                        @foreach ($institutes as $institute)
                            <option value="{{ $institute->id }}"
                                {{ request('institute_id') == $institute->id ? 'selected' : '' }}>
                                {{ $institute->name }}
                            </option>
                        @endforeach

                    </select>

                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Filter
                    </button>

                    <a href="{{ route('trades.index') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
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
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Institute</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Trade</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($trades as $trade)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm">{{ $trade->institute->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm">{{ $trade->name }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="px-2 py-1 text-sm rounded
                                        {{ $trade->status == 'active' ? 'bg-green-200' : 'bg-red-200' }}">
                                        {{ ucfirst($trade->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('trades.edit', $trade) }}" class="text-blue-600 mr-2">Edit</a>
                                    <form method="POST"
                                        action="{{ route('trades.destroy', $trade->id) }}"
                                        class="delete-form inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                                onclick="confirmDelete(this)"
                                                class="text-red-600 hover:text-red-800 delete-form">
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
                    {{ $trades->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
<div class="max-w-7xl mx-auto p-6">

    <div class="flex justify-between mb-4">
        <h2 class="text-xl font-bold">Trades</h2>
        <a href="{{ route('trades.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            + Add Trade
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border">
        <thead class="p-4 bg-green-50 hover:bg-green-100 rounded shadow text-center">
            <tr>
                <th class="p-2 border">Institute</th>
                <th class="p-2 border">Trade</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trades as $trade)
            <tr>
                <td class="p-2 border">{{ $trade->institute->name }}</td>
                <td class="p-2 border">{{ $trade->name }}</td>
                <td class="p-2 border">
                    <span class="px-2 py-1 text-sm rounded
                        {{ $trade->status == 'active' ? 'bg-green-200' : 'bg-red-200' }}">
                        {{ ucfirst($trade->status) }}
                    </span>
                </td>
                <td class="p-2 border">
                    <a href="{{ route('trades.edit', $trade) }}" class="text-blue-600 mr-2">Edit</a>

                    <form action="{{ route('trades.destroy', $trade) }}"
                          method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete this trade?')"
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
        {{ $trades->links() }}
    </div>
</div>
</x-app-layout>
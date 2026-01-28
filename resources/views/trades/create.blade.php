<x-app-layout>
<div class="max-w-xl mx-auto p-6">
    <h2 class="text-xl font-bold mb-4">Create Trade</h2>

    <form method="POST" action="{{ route('trades.store') }}">
        @csrf
        @include('trades.partials.form')
        <button class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>
</x-app-layout>

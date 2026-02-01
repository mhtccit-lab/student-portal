<x-app-layout>
    <div class="max-w-xl mx-auto p-6">
        <h2 class="text-xl font-bold mb-4">Create Institute</h2>
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('institutes.store') }}">
            @csrf

            @include('institutes.partials.form')

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Save
            </button>
        </form>
    </div>
</x-app-layout>
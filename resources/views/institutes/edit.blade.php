<x-app-layout>
    <div class="max-w-xl mx-auto p-6">
        <h2 class="text-xl font-bold mb-4">Edit Institute</h2>

        <form method="POST" action="{{ route('institutes.update', $institute) }}">
            @csrf
            @method('PUT')

            @include('institutes.partials.form', ['institute' => $institute])

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>
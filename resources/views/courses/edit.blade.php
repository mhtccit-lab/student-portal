<x-app-layout>
    <div class="max-w-xl mx-auto py-6">

        <h2 class="text-xl font-bold mb-4">Edit Course</h2>
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('courses.update', $course) }}">
            @csrf
            @method('PUT')

            {{-- Trade --}}
            <div class="mb-3">
                <label class="block mb-1">Trade</label>
                <select name="trade_id" class="w-full border p-2">
                    @foreach($trades as $trade)
                        <option value="{{ $trade->id }}"
                            {{ $course->trade_id == $trade->id ? 'selected' : '' }}>
                            {{ $trade->name }}
                        </option>
                    @endforeach
                </select>
                @error('trade_id')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Course Name --}}
            <div class="mb-3">
                <label class="block mb-1">Course Name</label>
                <input type="text"
                       name="name"
                       class="w-full border p-2"
                       value="{{ old('name', $course->name) }}">
                @error('name')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Duration --}}
            <div class="mb-3">
                <label class="block mb-1">Duration</label>
                <input type="number"
                       name="duration"
                       class="w-full border p-2"
                       value="{{ old('duration', $course->duration) }}">
                @error('duration')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Price --}}
            <div class="mb-3">
                <label class="block mb-1">Price</label>
                <input type="number"
                       step="0.01"
                       name="price"
                       class="w-full border p-2"
                       value="{{ old('price', $course->price) }}">
                @error('price')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label class="block mb-1">Status</label>
                <select name="status" class="w-full border p-2">
                    <option value="active"
                        {{ old('status', $course->status) == 'active' ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="inactive"
                        {{ old('status', $course->status) == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
                @error('status')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex justify-between">
                <a href="{{ route('courses.index') }}"
                   class="px-4 py-2 border rounded">
                    Cancel
                </a>

                <button class="bg-blue-600 text-white px-4 py-2 rounded">
                    Update Course
                </button>
            </div>

        </form>
    </div>
</x-app-layout>
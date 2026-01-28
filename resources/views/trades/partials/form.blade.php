<div class="mb-4">
    <label class="block mb-1">Institute</label>
    <select name="institute_id" class="w-full border p-2 rounded">
        @foreach($institutes as $institute)
            <option value="{{ $institute->id }}"
                {{ old('institute_id', $trade->institute_id ?? '') == $institute->id ? 'selected' : '' }}>
                {{ $institute->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label class="block mb-1">Trade Name</label>
    <input type="text" name="name"
           value="{{ old('name', $trade->name ?? '') }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label class="block mb-1">Description</label>
    <textarea name="description"
              class="w-full border p-2 rounded">{{ old('description', $trade->description ?? '') }}</textarea>
</div>

<div class="mb-4">
    <label class="block mb-1">Status</label>
    <select name="status" class="w-full border p-2 rounded">
        <option value="active"
            {{ old('status', $trade->status ?? '') == 'active' ? 'selected' : '' }}>
            Active
        </option>
        <option value="inactive"
            {{ old('status', $trade->status ?? '') == 'inactive' ? 'selected' : '' }}>
            Inactive
        </option>
    </select>
</div>

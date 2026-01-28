<div class="mb-4">
    <label class="block mb-1">Name</label>
    <input type="text" name="name"
           value="{{ old('name', $institute->name ?? '') }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label class="block mb-1">Code</label>
    <input type="text" name="code"
           value="{{ old('code', $institute->code ?? '') }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-4">
    <label class="block mb-1">Address</label>
    <textarea name="address"
              class="w-full border p-2 rounded">{{ old('address', $institute->address ?? '') }}</textarea>
</div>

<div class="mb-4">
    <label class="block mb-1">Status</label>
    <select name="status" class="w-full border p-2 rounded">
        <option value="active"
            {{ old('status', $institute->status ?? '') == 'active' ? 'selected' : '' }}>
            Active
        </option>
        <option value="inactive"
            {{ old('status', $institute->status ?? '') == 'inactive' ? 'selected' : '' }}>
            Inactive
        </option>
    </select>
</div>
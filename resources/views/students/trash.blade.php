<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Trashed Students
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="mb-4">
                <a href="{{ route('students.index') }}"
                   class="text-indigo-600 hover:underline">
                    ← Back to Students
                </a>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600">Name</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-600">Email</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-600">Deleted At</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-600">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse($students as $student)
                            <tr>
                                <td class="px-4 py-3">
                                    {{ $student->full_name_english }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $student->email }}
                                </td>

                                <td class="px-4 py-3 text-center text-sm">
                                    {{ $student->deleted_at->format('d M Y') }}
                                </td>

                                <td class="px-4 py-3 text-center space-x-2">

                                    {{-- Restore --}}
                                    <form method="POST"
                                          action="{{ route('students.restore', $student->id) }}"
                                          class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button class="text-green-600 hover:text-green-800">
                                            Restore
                                        </button>
                                    </form>

                                    {{-- Permanent delete --}}
                                    <form method="POST"
                                          action="{{ route('students.forceDelete', $student->id) }}"
                                          class="inline delete-form">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button"
                                                onclick="confirmDelete(this)"
                                                class="text-red-600 hover:text-red-800">
                                            Delete Forever
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-6 text-gray-500">
                                    Trash is empty
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="p-4">
                    {{ $students->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
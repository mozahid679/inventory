<x-layouts.app>
    <div class="p-6">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-white">Edit Permission</h2>
            <p class="text-sm text-gray-400">Update the access level name for the system.</p>
        </div>

        <div class="max-w-2xl rounded-xl border border-gray-700 bg-gray-800 p-6 shadow-lg">
            <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div>
                        <label class="mb-1 block text-sm font-medium text-gray-400">Permission Name *</label>
                        <input
                            class="w-full rounded-md border-gray-600 bg-gray-700 px-3 py-2 text-white focus:border-indigo-500 focus:ring-indigo-500"
                            name="name" type="text" value="{{ old('name', $permission->name) }}"
                            placeholder="e.g., product_delete" required>
                        @error('name')
                            <span class="mt-1 text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center gap-3 pt-4">
                        <button
                            class="rounded-lg bg-indigo-600 px-6 py-2 font-medium text-white transition hover:bg-indigo-700"
                            type="submit">
                            Update Permission
                        </button>
                        <a class="text-sm text-gray-400 transition hover:text-white"
                            href="{{ route('admin.permissions.index') }}">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>

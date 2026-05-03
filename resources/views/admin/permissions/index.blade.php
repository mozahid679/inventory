<x-layouts.app>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Permission Master List</h2>
        </div>
    </div>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div
                class="mb-8 overflow-hidden rounded-xl border border-blue-100 bg-gradient-to-r from-blue-50 to-white p-6 shadow-sm dark:border-gray-700 dark:from-gray-800 dark:to-gray-900">
                <div class="flex flex-col gap-4 md:flex-row md:items-center">
                    <div class="flex-shrink-0 md:w-64">
                        <h3 class="text-sm font-bold uppercase tracking-tight text-blue-900 dark:text-blue-300">Create
                            New Permission</h3>
                        <p class="text-xs text-blue-600/70 dark:text-gray-400">Use underscores for names (e.g. <span
                                class="font-mono">user_edit</span>)</p>
                    </div>

                    <form class="flex flex-1 items-start gap-3" action="{{ route('admin.permissions.store') }}"
                        method="POST">
                        @csrf
                        <div class="relative flex-1">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <input
                                class="w-full rounded-lg border-gray-200 py-2.5 pl-10 pr-4 text-sm transition focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                name="name" type="text" value="{{ old('name') }}"
                                placeholder="Enter permission name..." required>

                            @error('name')
                                <p class="absolute -bottom-5 left-0 text-xs font-medium text-red-500">
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        <button
                            class="group inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-md shadow-blue-200 transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:shadow-none"
                            type="submit">
                            <span>Add Permission</span>
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M13 7l5 5m0 0l-5 5m5-5H6" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <div
                class="overflow-hidden rounded-lg border border-gray-200 bg-white p-4 shadow dark:border-gray-700 dark:bg-gray-800">

                @php
                    // Group permissions by the prefix (e.g., 'product', 'role', 'product-type')
                    // We split by the first underscore to determine the group name.
                    $groupedPermissions = $permissions->groupBy(function ($permission) {
                        return explode('_', $permission->name)[0];
                    });
                @endphp

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    @foreach ($groupedPermissions as $group => $items)
                        <div
                            class="space-y-4 rounded-xl border border-gray-200 bg-gray-50/50 p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800/50">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                {{ str_replace('-', ' ', $group) }} Permissions
                            </h3>

                            <div class="space-y-2">
                                @foreach ($items as $permission)
                                    <div
                                        class="flex items-center justify-between rounded-lg border border-gray-200 bg-white p-3 transition dark:border-gray-700 dark:bg-gray-800">

                                        @if (request('edit') == $permission->id)
                                            <form class="flex flex-1 gap-2"
                                                action="{{ route('admin.permissions.update', $permission) }}"
                                                method="POST">
                                                @csrf @method('PUT')
                                                <input
                                                    class="flex-1 rounded border-gray-300 px-2 py-1 text-sm dark:bg-gray-700 dark:text-white"
                                                    name="name" type="text" value="{{ $permission->name }}">
                                                <div class="flex items-center justify-end gap-3">
                                                    <button
                                                        class="rounded-2xl border border-gray-400 px-2 py-1 text-xs font-bold text-green-600 hover:text-green-700 dark:border-gray-600"
                                                        type="submit">Save</button>
                                                    <a class="text-xs text-gray-400"
                                                        href="{{ route('admin.permissions.index') }}">Cancel</a>
                                                </div>
                                            </form>
                                        @else
                                            <span class="font-mono text-sm text-gray-900 dark:text-white">
                                                {{ $permission->name }}
                                            </span>

                                            <div class="flex items-center gap-2">
                                                <a class="rounded p-1 text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/30"
                                                    href="{{ route('admin.permissions.index', ['edit' => $permission->id]) }}">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"></path>
                                                    </svg>
                                                </a>

                                                <form action="{{ route('admin.permissions.destroy', $permission) }}"
                                                    method="POST" onsubmit="return confirm('Delete?')">
                                                    @csrf @method('DELETE')
                                                    <button
                                                        class="rounded p-1 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30"
                                                        type="submit">
                                                        <svg class="h-4 w-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>

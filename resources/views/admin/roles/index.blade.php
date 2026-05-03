<x-layouts.app>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Roles Management') }}
            </h2>
            @can('role_create')
                <a class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    href="{{ route('admin.roles.create') }}">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Create Role
                </a>
            @endcan
        </div>
    </div>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6">
                    @if (session('success'))
                        <div class="mb-4 rounded-lg bg-green-100 p-4 text-sm text-green-700 dark:bg-green-900/30 dark:text-green-400"
                            role="alert">
                            <span class="font-medium">Success!</span> {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                            <thead
                                class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700/50 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-4 font-bold">#</th>
                                    <th class="px-6 py-4 font-bold">Role Name</th>
                                    <th class="px-6 py-4 font-bold">Designation</th>
                                    <th class="px-6 py-4 font-bold">Permissions</th>
                                    <th class="px-6 py-4 text-right font-bold">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($roles as $role)
                                    <tr
                                        class="bg-white transition-colors hover:bg-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700/50">
                                        <td class="px-6 py-4 font-bold">{{ $role->id }}</td>
                                        <td
                                            class="whitespace-nowrap px-6 py-4 font-medium capitalize text-gray-900 dark:text-white">
                                            {{ $role->name }}
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-6 py-4 font-medium capitalize text-gray-900 dark:text-white">
                                            {{ $role->designation }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-800 dark:bg-blue-900/40 dark:text-blue-300">
                                                {{ $role->permissions->count() }} permissions
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            @canany(['role_edit', 'role_delete'])
                                                <div class="flex justify-end space-x-2">
                                                    @can('role_edit')
                                                        <a class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-gray-500 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                                                            href="{{ route('admin.roles.edit', $role) }}">
                                                            <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path
                                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                                                    stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                            </svg>
                                                            Edit
                                                        </a>
                                                    @endcan
                                                    @can('role_delete')
                                                        <form class="inline" action="{{ route('admin.roles.destroy', $role) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                class="inline-flex items-center rounded-lg border border-red-300 bg-white px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 focus:outline-none focus:ring-4 focus:ring-red-200 dark:border-red-900 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-red-900/20 dark:focus:ring-red-900"
                                                                type="submit"
                                                                onclick="return confirm('Are you sure you want to delete this role?')">
                                                                <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                                        stroke-width="2" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                </svg>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            @endcanany

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

<x-layouts.app>
    <div class="p-6">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                    {{ __('Users Management') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Manage your staff members, roles, and profile
                    information.</p>
            </div>
            <a class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700"
                href="{{ route('admin.users.create') }}">
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New User
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 flex items-center rounded-lg bg-green-100 p-4 text-green-700 dark:bg-green-900/30 dark:text-green-400"
                role="alert">
                <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div
            class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left">
                    <thead class="bg-gray-50 dark:bg-gray-700/50">
                        <tr>
                            <th
                                class="border-b px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500 dark:border-gray-700 dark:text-gray-400">
                                Staff Member
                            </th>
                            <th
                                class="border-b px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500 dark:border-gray-700 dark:text-gray-400">
                                Contact & Info
                            </th>
                            <th
                                class="border-b px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500 dark:border-gray-700 dark:text-gray-400">
                                Roles
                            </th>
                            <th
                                class="border-b px-6 py-4 text-xs font-bold uppercase tracking-wider text-gray-500 dark:border-gray-700 dark:text-gray-400">
                                Joined
                            </th>
                            <th
                                class="border-b px-6 py-4 text-right text-xs font-bold uppercase tracking-wider text-gray-500 dark:border-gray-700 dark:text-gray-400">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($users as $user)
                            <tr class="group transition hover:bg-gray-50 dark:hover:bg-gray-700/30">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <img class="h-10 w-10 rounded-full object-cover ring-2 ring-gray-100 dark:ring-gray-700"
                                                src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/default-avatar.png') }}"
                                                alt="{{ $user->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900 dark:text-white">
                                                {{ $user->name }}</div>
                                            <div class="text-xs font-medium text-blue-600 dark:text-blue-400">
                                                {{ $user->designation ?? 'No Designation' }}</div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-col text-sm">
                                        <span class="text-gray-700 dark:text-gray-300">{{ $user->email }}</span>
                                        <span class="text-xs text-gray-500">{{ $user->phone_no ?? 'N/A' }}</span>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-1">
                                        @forelse($user->roles as $role)
                                            <span
                                                class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-bold text-blue-700 ring-1 ring-inset ring-blue-700/10 dark:bg-blue-900/30 dark:text-blue-300">
                                                {{ strtoupper($role->name) }}
                                            </span>
                                        @empty
                                            <span class="text-xs italic text-gray-400">No Roles</span>
                                        @endforelse
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end space-x-2">
                                        <a class="p-2 text-gray-400 transition hover:text-blue-600 dark:hover:text-blue-400"
                                            href="{{ route('admin.users.edit', $user) }}" title="Edit User">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>

                                        @if ($user->id !== auth()->id())
                                            <form class="inline" action="{{ route('admin.users.destroy', $user) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="p-2 text-gray-400 transition hover:text-red-600 dark:hover:text-red-400"
                                                    type="submit" title="Delete User"
                                                    onclick="return confirm('Permanently delete {{ $user->name }}?')">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
                <div class="border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-800/50">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>

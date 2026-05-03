<x-layouts.app>
    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div
                class="flex items-center justify-between overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div>
                    <div class="border-l-4 border-blue-500 pl-4">
                        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">
                            {{ __('Editing') }} <span class="font-medium text-gray-500 dark:text-gray-400">/</span>
                            <span class="text-blue-600 dark:text-blue-400">{{ $role->name }}</span>
                        </h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Modify role: <span
                                class="font-medium text-blue-400">{{ $role->name }}</span> details and
                            permissions</p>
                    </div>
                </div>

                <a class="inline-flex items-center gap-2 rounded-lg bg-gray-50 px-3 py-2 text-sm font-medium text-gray-600 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:bg-gray-700 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-gray-200"
                    href="{{ route('admin.roles.index') }}">
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Roles
                </a>
            </div>

            <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4 grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="grid grid-cols-2 gap-4">

                        <div
                            class="mt-6 rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-900/50">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Role
                                Name</label>
                            <input
                                class="mt-1 block w-full rounded-md border-gray-300 px-2 py-1.5 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-600"
                                name="name" type="text" value="{{ $role->name }}">
                        </div>

                        <div
                            class="mt-6 rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-900/50">
                            <h3 class="mb-3 text-sm font-semibold text-gray-700 dark:text-gray-200">Assign User
                                Roles
                            </h3>
                            <div class="space-y-2">
                                @foreach ($roles as $role)
                                    <label class="group flex cursor-pointer items-center"
                                        for="role_{{ $role->id }}">
                                        <input
                                            class="h-4 w-4 rounded border-gray-300 text-blue-600 transition focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800"
                                            id="role_{{ $role->id }}" name="roles[]" type="checkbox"
                                            value="{{ $role->name }}" @checked($user->hasRole($role->name))>
                                        <span
                                            class="ml-2 text-sm text-gray-600 transition group-hover:text-blue-600 dark:text-gray-400 dark:group-hover:text-blue-400">
                                            {{ ucfirst($role->name) }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="mb-4 block text-sm font-medium text-gray-900 dark:text-gray-100">
                        Assign Permissions
                    </label>

                    <div class="grid grid-cols-2 gap-4">
                        @foreach ($permissions->groupBy(fn($p) => explode('-', str_replace('_', '-', $p->name))[0]) as $group => $groupPermissions)
                            <div
                                class="rounded-lg border border-gray-200 bg-gray-50 p-4 dark:border-gray-700 dark:bg-gray-900/50">

                                <div
                                    class="mb-4 flex items-center justify-between border-b border-gray-200 pb-2 dark:border-gray-700">
                                    <h3
                                        class="text-sm font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400">
                                        {{ $group }} Management
                                    </h3>
                                    <div class="flex items-center">
                                        <input
                                            class="h-4 w-4 cursor-pointer rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                            id="select_all_{{ $group }}" type="checkbox"
                                            onclick="toggleGroup('{{ $group }}', this.checked)"
                                            {{-- Logic: If all permissions in this group are assigned, check 'Select All' --}} @if ($groupPermissions->every(fn($p) => $role->hasPermissionTo($p->name))) checked @endif>
                                        <label class="ml-2 cursor-pointer text-xs font-semibold uppercase text-gray-500"
                                            for="select_all_{{ $group }}">
                                            Select All
                                        </label>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                    @foreach ($groupPermissions as $permission)
                                        <div class="flex items-center">
                                            <input
                                                class="permission-checkbox-{{ $group }} h-4 w-4 rounded border-gray-300 bg-white text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700"
                                                id="permission_{{ $permission->id }}" name="permissions[]"
                                                type="checkbox" value="{{ $permission->name }}" {{-- Logic: Check if permission is already assigned --}}
                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                            <label
                                                class="ml-2 text-sm font-medium capitalize text-gray-700 dark:text-gray-300"
                                                for="permission_{{ $permission->id }}">
                                                {{ str_replace(['-', '_', $group], [' ', ' ', ''], $permission->name) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @error('permissions')
                        <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-6 flex justify-end">
                    <button
                        class="rounded bg-blue-600 px-4 py-2 text-white shadow transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                        type="submit">
                        Save Role Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script>
        function toggleGroup(groupName, isChecked) {
            // Select all checkboxes that have the class specific to this group
            const checkboxes = document.querySelectorAll('.permission-checkbox-' + groupName);

            checkboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        }
    </script>
</x-layouts.app>

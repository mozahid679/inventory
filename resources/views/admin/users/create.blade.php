<x-layouts.app>
    <div class="p-6">
        <div class="mx-auto max-w-4xl">
            <div class="mb-6 flex items-center space-x-4">
                <a class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
                    href="{{ route('admin.users.index') }}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                    {{ __('Create New User') }}
                </h2>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 gap-6">
                    <div
                        class="rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
                        <h3
                            class="mb-4 border-b pb-2 text-lg font-semibold text-gray-700 dark:border-gray-700 dark:text-gray-200">
                            Account Details
                        </h3>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                                    for="name">Full Name</label>
                                <input
                                    class="mt-1 block w-full rounded-md border-gray-300 py-1.5 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    id="name" name="name" type="text" value="{{ old('name') }}" required>
                                @error('name')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                                    for="email">Email Address</label>
                                <input
                                    class="mt-1 block w-full rounded-md border-gray-300 py-1.5 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    id="email" name="email" type="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                                    for="password">Password</label>
                                <input
                                    class="mt-1 block w-full rounded-md border-gray-300 py-1.5 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    id="password" name="password" type="password" required>
                                @error('password')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-2 md:col-span-1">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300"
                                    for="password_confirmation">Confirm Password</label>
                                <input
                                    class="mt-1 block w-full rounded-md border-gray-300 py-1.5 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    id="password_confirmation" name="password_confirmation" type="password" required>
                            </div>
                        </div>
                    </div>

                    <div
                        class="rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
                        <h3
                            class="mb-4 border-b pb-2 text-lg font-semibold text-gray-700 dark:border-gray-700 dark:text-gray-200">
                            Assign Initial Roles
                        </h3>

                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            @foreach ($roles as $role)
                                <label
                                    class="relative flex cursor-pointer items-start rounded-lg border border-gray-200 p-3 transition hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-700/50">
                                    <div class="flex h-5 items-center">
                                        <input
                                            class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-900"
                                            name="roles[]" type="checkbox" value="{{ $role->name }}">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <span class="font-medium capitalize text-gray-700 dark:text-gray-200">
                                            {{ str_replace('_', ' ', $role->name) }}
                                        </span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('roles')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end space-x-4">
                        <a class="text-sm font-medium text-gray-600 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200"
                            href="{{ route('admin.users.index') }}">
                            Cancel
                        </a>
                        <button
                            class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 px-6 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                            type="submit">
                            Create User
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>

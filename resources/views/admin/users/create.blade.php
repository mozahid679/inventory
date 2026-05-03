<x-layouts.app>
    <div class="p-6">
        <div class="mx-auto max-w-5xl">
            <div class="mb-6 flex items-center space-x-4">
                <a class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-gray-500 shadow-sm transition hover:bg-gray-50 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700"
                    href="{{ route('admin.users.index') }}">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                        {{ __('Create New User') }}
                    </h2>
                    <p class="text-sm text-gray-500">Register a new staff member and assign system permissions.</p>
                </div>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

                    <div class="space-y-4 md:col-span-1">
                        <div
                            class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <h3 class="mb-4 text-xs font-bold uppercase tracking-wider text-gray-500">Profile Photo</h3>

                            <div class="flex flex-col items-center">
                                <div class="group relative">
                                    <div
                                        class="h-32 w-32 overflow-hidden rounded-full border-4 border-gray-100 shadow-inner dark:border-gray-700">
                                        <img class="h-full w-full object-cover" id="avatar-preview"
                                            src="{{ asset('images/default-avatar.png') }}" alt="Preview">
                                    </div>
                                    <div
                                        class="pointer-events-none absolute inset-0 flex items-center justify-center rounded-full bg-black/20 opacity-0 transition group-hover:opacity-100">
                                        <i class="fas fa-camera text-xl text-white"></i>
                                    </div>
                                </div>

                                <div class="mt-4 w-full">
                                    <input
                                        class="block w-full cursor-pointer text-xs text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-xs file:font-semibold file:text-blue-700 hover:file:bg-blue-100 focus:outline-none dark:file:bg-gray-700 dark:file:text-gray-300"
                                        id="photo" name="photo" type="file"
                                        accept="image/png, image/jpeg, image/jpg, image/webp"
                                        onchange="previewImage(event)">
                                    @error('photo')
                                        <p class="mt-2 text-center text-xs font-medium text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div
                            class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <h3 class="mb-4 text-sm font-bold uppercase tracking-wider text-gray-500">System Roles</h3>
                            <div class="grid grid-cols-1 gap-3 sm:grid-cols-3">
                                @foreach ($roles as $role)
                                    <label
                                        class="relative flex cursor-pointer items-center rounded-lg border border-gray-100 bg-gray-50 p-3 transition hover:border-blue-300 hover:bg-blue-50 dark:border-gray-700 dark:bg-gray-900/50 dark:hover:bg-gray-700">
                                        <input class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                            name="roles[]" type="checkbox" value="{{ $role->name }}">
                                        <span
                                            class="ml-3 text-xs font-bold capitalize text-gray-700 dark:text-gray-200">
                                            {{ str_replace('_', ' ', $role->name) }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                            @error('roles')
                                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-6 md:col-span-2">
                        <div
                            class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <h3
                                class="mb-4 border-b pb-2 text-sm font-bold uppercase tracking-wider text-gray-500 dark:border-gray-700">
                                Personal Information
                            </h3>

                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300"
                                        for="name">Full Name</label>
                                    <input
                                        class="mt-1 block w-full rounded-lg border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        id="name" name="name" type="text" value="{{ old('name') }}"
                                        placeholder="John Doe" required>
                                    @error('name')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300"
                                        for="email">Email Address</label>
                                    <input
                                        class="mt-1 block w-full rounded-lg border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        id="email" name="email" type="email" value="{{ old('email') }}"
                                        placeholder="john@example.com" required>
                                    @error('email')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300"
                                        for="designation">Designation</label>
                                    <input
                                        class="mt-1 block w-full rounded-lg border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        id="designation" name="designation" type="text"
                                        value="{{ old('designation') }}" placeholder="e.g. Senior Manager">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300"
                                        for="phone_no">Phone Number</label>
                                    <input
                                        class="mt-1 block w-full rounded-lg border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        id="phone_no" name="phone_no" type="text" value="{{ old('phone_no') }}"
                                        placeholder="+1 234 567 890">
                                </div>

                                <div class="sm:col-span-2">
                                    <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300"
                                        for="address">Mailing Address</label>
                                    <textarea
                                        class="mt-1 block w-full rounded-lg border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        id="address" name="address" rows="2">{{ old('address') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div
                            class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <h3
                                class="mb-4 border-b pb-2 text-sm font-bold uppercase tracking-wider text-gray-500 dark:border-gray-700">
                                Security</h3>
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300"
                                        for="password">Password</label>
                                    <input
                                        class="mt-1 block w-full rounded-lg border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        id="password" name="password" type="password" required>
                                    @error('password')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300"
                                        for="password_confirmation">Confirm Password</label>
                                    <input
                                        class="mt-1 block w-full rounded-lg border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        id="password_confirmation" name="password_confirmation" type="password"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-4 pb-10">
                            <a class="text-sm font-semibold text-gray-500 hover:text-gray-700 dark:text-gray-400"
                                href="{{ route('admin.users.index') }}">Cancel</a>
                            <button
                                class="rounded-lg bg-blue-600 px-8 py-3 text-sm font-bold text-white shadow-lg shadow-blue-200 transition hover:bg-blue-700 active:scale-95 dark:shadow-none"
                                type="submit">
                                Create User Account
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('avatar-preview');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-layouts.app>

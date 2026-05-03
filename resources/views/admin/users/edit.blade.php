<x-layouts.app>
    <div class="min-h-screen bg-gray-50 p-6 dark:bg-gray-900">
        <div class="mx-auto max-w-4xl">
            <div class="mb-6 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-gray-500 shadow-sm transition hover:text-blue-600 dark:bg-gray-800 dark:text-gray-400"
                        href="{{ route('admin.users.index') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Edit Staff Member</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Updating profile for {{ $user->name }}</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                        <div
                            class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm md:col-span-1 dark:border-gray-700 dark:bg-gray-800">
                            <h3
                                class="mb-4 text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Profile Photo</h3>
                            <div class="flex flex-col items-center">
                                <div class="group relative">
                                    <div
                                        class="h-32 w-32 overflow-hidden rounded-full border-4 border-gray-100 shadow-md dark:border-gray-700">
                                        <img class="h-full w-full object-cover" id="photo"
                                            src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/default-avatar.png') }}"
                                            alt="{{ $user->name }}">
                                    </div>

                                    <div
                                        class="pointer-events-none absolute inset-0 flex items-center justify-center rounded-full bg-black/20 opacity-0 transition group-hover:opacity-100">
                                        <i class="fas fa-camera text-xl text-white"></i>
                                    </div>
                                </div>

                                <div class="mt-4 w-full">
                                    <label
                                        class="my-4 block text-center text-[10px] font-bold uppercase tracking-wider text-gray-400"
                                        for="photo">
                                        Change Photo
                                    </label>

                                    <input
                                        class="block w-full cursor-pointer text-xs text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-xs file:font-semibold file:text-blue-700 hover:file:bg-blue-100 focus:outline-none dark:file:bg-gray-700 dark:file:text-gray-300 dark:hover:file:bg-gray-600"
                                        id="photo" name="photo" type="file"
                                        accept="image/png, image/jpeg, image/jpg, image/webp"
                                        onchange="previewImage(event)">

                                    @error('photo')
                                        <p class="mt-2 text-center text-xs font-medium text-red-500">{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div
                            class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm md:col-span-2 dark:border-gray-700 dark:bg-gray-800">
                            <h3
                                class="mb-4 text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                Basic Information</h3>
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div>
                                    <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300"
                                        for="name">Full Name</label>
                                    <input
                                        class="mt-1 block w-full rounded-lg border-gray-300 px-2 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        id="name" name="name" type="text"
                                        value="{{ old('name', $user->name) }}">
                                    @error('name')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300"
                                        for="email">Email Address</label>
                                    <input
                                        class="mt-1 block w-full rounded-lg border-gray-300 px-2 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        id="email" name="email" type="email"
                                        value="{{ old('email', $user->email) }}">
                                    @error('email')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300"
                                        for="designation">Designation</label>
                                    <input
                                        class="mt-1 block w-full rounded-lg border-gray-300 px-2 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        id="designation" name="designation" type="text"
                                        value="{{ old('designation', $user->designation) }}">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300"
                                        for="phone_no">Phone Number</label>
                                    <input
                                        class="mt-1 block w-full rounded-lg border-gray-300 px-2 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        id="phone_no" name="phone_no" type="text"
                                        value="{{ old('phone_no', $user->phone_no) }}">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300"
                                        for="address">Mailing Address</label>
                                    <textarea
                                        class="mt-1 block w-full rounded-lg border-gray-300 px-2 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        id="address" name="address" rows="3">{{ old('address', $user->address) }}</textarea>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold uppercase text-gray-700 dark:text-gray-300"
                                        for="password">New Password (Leave blank to keep current)</label>
                                    <input
                                        class="mt-1 block w-full rounded-lg border-gray-300 px-2 py-2 text-sm shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        id="password" name="password" type="password" placeholder="••••••••">
                                    <p class="mt-2 text-[10px] text-gray-400">For security, only admins can force a
                                        password
                                        reset here.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-2">

                        <div
                            class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                            <h3
                                class="mb-4 text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                System Permissions & Roles</h3>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-1 lg:grid-cols-2">
                                @foreach ($roles as $role)
                                    <label
                                        class="relative flex cursor-pointer items-start rounded-xl border border-gray-100 bg-gray-50/50 p-4 transition hover:border-blue-300 hover:bg-blue-50 dark:border-gray-700 dark:bg-gray-900/50 dark:hover:bg-gray-700">
                                        <div class="flex h-5 items-center">
                                            <input
                                                class="h-5 w-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600"
                                                name="roles[]" type="checkbox" value="{{ $role->name }}"
                                                {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                                        </div>
                                        <div class="ml-3">
                                            <span
                                                class="block text-sm font-bold capitalize text-gray-800 dark:text-gray-200">
                                                {{ str_replace('_', ' ', $role->name) }}
                                            </span>
                                            <span class="text-[10px] uppercase text-gray-500">Access Level</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-4 pb-10">
                            <a class="text-sm font-semibold text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
                                href="{{ route('admin.users.index') }}">
                                Discard Changes
                            </a>
                            <button
                                class="inline-flex justify-center rounded-lg bg-blue-600 px-8 py-3 text-sm font-bold text-white shadow-lg shadow-blue-200 transition hover:bg-blue-700 active:scale-95 active:transform dark:shadow-none"
                                type="submit">
                                Update Profile
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
                const output = document.getElementById('photo');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-layouts.app>

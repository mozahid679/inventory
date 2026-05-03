<x-layouts.app>
    <div class="mx-auto flex max-w-7xl items-center justify-between sm:px-6 lg:px-8">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Add New Supplier</h2>

        <div class="flex items-center gap-3">
            <button
                class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-xs font-medium uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                onclick="window.history.back()">
                <i class="fas fa-arrow-left mr-2"></i>
                {{ __('Back') }}
            </button>
        </div>
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg dark:bg-gray-800">
                <form action="{{ route('admin.suppliers.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label class="block text-sm font-medium text-gray-300">Company Name *</label>
                            <input
                                class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 px-2 py-1.5 text-white focus:border-blue-500 focus:ring-blue-500"
                                name="name" type="text" required>
                            @error('name')
                                <p class="text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300">Email Address</label>
                            <input
                                class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 px-2 py-1.5 text-white focus:border-blue-500 focus:ring-blue-500"
                                name="email" type="email">
                            @error('email')
                                <p class="text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300">Phone Number</label>
                            <input
                                class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 px-2 py-1.5 text-white focus:border-blue-500 focus:ring-blue-500"
                                name="phone" type="text">
                            @error('phone')
                                <p class="text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300">Full Address</label>
                            <textarea
                                class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 px-2 text-white focus:border-blue-500 focus:ring-blue-500"
                                name="address" rows="2"></textarea>
                            @error('address')
                                <p class="text-xs italic text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center shadow-sm sm:rounded-lg">
                            <label class="flex cursor-pointer items-center bg-white dark:bg-gray-800">
                                <input name="status" type="hidden" value="0">
                                <input
                                    class="h-4 w-4 rounded border-gray-600 bg-gray-700 text-blue-600 focus:ring-blue-500"
                                    name="status" type="checkbox" value="1"
                                    {{ old('status', '1') == '1' ? 'checked' : '' }}>
                                <span class="ml-2 text-sm font-medium text-gray-300">Active (Visible in
                                    Store)</span>
                                @error('status')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </label>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <a class="rounded-lg border border-gray-600 px-5 py-2.5 text-sm font-medium text-gray-300 hover:bg-gray-700"
                                href="{{ route('admin.suppliers.index') }}">Cancel</a>
                            <button
                                class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700"
                                type="submit">Save Supplier</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>

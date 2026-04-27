<x-layouts.app>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                {{ __('Edit Supplier') }}: {{ $supplier->name }}
            </h2>
            <a class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
                href="{{ route('admin.suppliers.index') }}">
                &larr; Back to List
            </a>
        </div>
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg dark:bg-gray-800">

                <form action="{{ route('admin.suppliers.update', $supplier) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Company Name
                                *</label>
                            <input
                                class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                name="name" type="text" value="{{ old('name', $supplier->name) }}" required>
                            @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email
                                Address</label>
                            <input
                                class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                name="email" type="email" value="{{ old('email', $supplier->email) }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone
                                Number</label>
                            <input
                                class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                name="phone" type="text" value="{{ old('phone', $supplier->phone) }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact
                                Person</label>
                            <input
                                class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                name="contact_person" type="text"
                                value="{{ old('contact_person', $supplier->contact_person) }}">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tax Number /
                                VAT</label>
                            <input
                                class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                name="tax_number" type="text" value="{{ old('tax_number', $supplier->tax_number) }}">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full
                                Address</label>
                            <textarea
                                class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                name="address" rows="3">{{ old('address', $supplier->address) }}</textarea>
                        </div>

                        <div class="md:col-span-2">
                            <label class="relative inline-flex cursor-pointer items-center">
                                <input class="peer sr-only" name="status" type="checkbox" value="1"
                                    {{ $supplier->status ? 'checked' : '' }}>
                                <div
                                    class="peer h-6 w-11 rounded-full bg-gray-200 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:border-gray-600 dark:bg-gray-700 dark:peer-focus:ring-blue-800">
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Active
                                    Supplier</span>
                            </label>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3 border-t border-gray-700 pt-6">
                        <a class="rounded-lg border border-gray-600 px-5 py-2.5 text-sm font-medium text-gray-300 hover:bg-gray-700"
                            href="{{ route('admin.suppliers.index') }}">
                            Cancel
                        </a>
                        <button
                            class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300"
                            type="submit">
                            Update Supplier
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-layouts.app>

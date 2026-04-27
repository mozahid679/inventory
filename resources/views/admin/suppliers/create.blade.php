<x-layouts.app>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Add New Supplier</h2>
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg dark:bg-gray-800">
                <form action="{{ route('admin.suppliers.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300">Company Name *</label>
                            <input
                                class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 py-1.5 text-white focus:border-blue-500 focus:ring-blue-500"
                                name="name" type="text" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300">Email Address</label>
                            <input
                                class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 py-1.5 text-white focus:border-blue-500 focus:ring-blue-500"
                                name="email" type="email">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300">Phone Number</label>
                            <input
                                class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 py-1.5 text-white focus:border-blue-500 focus:ring-blue-500"
                                name="phone" type="text">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300">Contact Person</label>
                            <input
                                class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 py-1.5 text-white focus:border-blue-500 focus:ring-blue-500"
                                name="contact_person" type="text">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-300">Tax Number / VAT</label>
                            <input
                                class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 py-1.5 text-white focus:border-blue-500 focus:ring-blue-500"
                                name="tax_number" type="text">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-300">Full Address</label>
                            <textarea
                                class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 text-white focus:border-blue-500 focus:ring-blue-500"
                                name="address" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end space-x-3">
                        <a class="rounded-lg border border-gray-600 px-5 py-2.5 text-sm font-medium text-gray-300 hover:bg-gray-700"
                            href="{{ route('admin.suppliers.index') }}">Cancel</a>
                        <button
                            class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-700"
                            type="submit">Save Supplier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>

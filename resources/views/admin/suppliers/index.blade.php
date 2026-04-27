<x-layouts.app>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Suppliers') }}
            </h2>
            <a class="inline-flex items-center rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700"
                href="{{ route('admin.suppliers.create') }}">
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Supplier
            </a>
        </div>
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead
                            class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700/50 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-4 font-bold">Company</th>
                                <th class="px-6 py-4 font-bold">Contact Person</th>
                                <th class="px-6 py-4 font-bold">Email/Phone</th>
                                <th class="px-6 py-4 font-bold">Status</th>
                                <th class="px-6 py-4 text-right font-bold">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($suppliers as $supplier)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900 dark:text-white">{{ $supplier->name }}
                                        </div>
                                        <div class="text-xs text-gray-400">{{ $supplier->city }},
                                            {{ $supplier->country }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300">
                                        {{ $supplier->contact_person ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-gray-900 dark:text-white">{{ $supplier->email }}</div>
                                        <div class="text-xs text-gray-400">{{ $supplier->phone }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="{{ $supplier->status ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' }} rounded-full px-2 py-1 text-xs font-semibold">
                                            {{ $supplier->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end space-x-3">
                                            <a class="text-blue-600 hover:underline dark:text-blue-400"
                                                href="{{ route('admin.suppliers.edit', $supplier) }}">Edit</a>
                                            <form action="{{ route('admin.suppliers.destroy', $supplier) }}"
                                                method="POST" onsubmit="return confirm('Delete this supplier?');">
                                                @csrf @method('DELETE')
                                                <button
                                                    class="text-red-600 hover:underline dark:text-red-400">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-6 py-10 text-center text-gray-500" colspan="5">No suppliers found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

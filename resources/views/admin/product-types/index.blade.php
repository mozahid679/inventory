<x-layouts.app>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h2 class="text-center text-2xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Category Types Management') }}
        </h2>
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

                <div class="md:col-span-1">
                    @can('product-type_create')
                        <div class="overflow-hidden bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800">
                            <h3 class="mb-4 text-lg font-medium text-gray-900 dark:text-white">Add New Type</h3>
                            <form action="{{ route('admin.product-types.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type
                                        Name</label>
                                    <input
                                        class="mt-1 block w-full rounded-md border-gray-300 px-2 py-1.5 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        name="name" type="text" required placeholder="e.g., Electronics">
                                </div>
                                <div class="mb-4">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                    <textarea
                                        class="mt-1 block w-full rounded-md border-gray-300 px-2 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                        name="description" rows="3"></textarea>
                                </div>
                                <button
                                    class="w-full rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600"
                                    type="submit">
                                    Save Category Type
                                </button>
                            </form>
                        </div>
                    @endcan
                </div>

                <div class="md:col-span-2">
                    <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                                <thead
                                    class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700/50 dark:text-gray-400">
                                    <tr>
                                        <th class="px-6 py-4 font-bold">Name</th>
                                        @canany(['product-type_edit', 'product-type_delete'])
                                            <th class="px-6 py-4 text-right font-bold">Actions</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach ($types as $type)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                                {{ $type->name }}
                                            </td>
                                            @canany(['product-type_edit', 'product-type_delete'])
                                                <td class="px-6 py-4 text-right">
                                                    <div class="flex justify-end space-x-2">
                                                        @can('product-type_edit')
                                                            <a class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-gray-500 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                                                                href="{{ route('admin.product-types.edit', $type) }}">
                                                                <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path
                                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                                                        stroke-width="2" stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                    </path>
                                                                </svg>Edit</a>
                                                        @endcan
                                                        <form class="inline"
                                                            action="{{ route('admin.product-types.destroy', $type) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Delete this Category Type?');">
                                                            @csrf @method('DELETE')
                                                            <button
                                                                class="inline-flex items-center rounded-lg border border-red-300 bg-white px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 focus:outline-none focus:ring-4 focus:ring-red-200 dark:border-red-900 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-red-900/20 dark:focus:ring-red-900"
                                                                type="submit">
                                                                <svg class="mr-1 h-3 w-3" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                                        stroke-width="2" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                </svg>Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endcanany
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>

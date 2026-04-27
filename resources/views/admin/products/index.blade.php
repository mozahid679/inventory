<x-layouts.app>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Products') }}
            </h2>
            @can('product_create')
                <a class="inline-flex items-center rounded-lg bg-blue-700 px-4 py-2 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700"
                    href="{{ route('admin.products.create') }}">
                    <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Product
                </a>
            @endcan
        </div>
    </div>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead
                            class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700/50 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-4 font-bold">#</th>
                                <th class="px-6 py-4 font-bold">Product</th>
                                <th class="px-6 py-4 font-bold">Image</th>
                                <th class="px-6 py-4 font-bold">Category</th>
                                <th class="px-6 py-4 text-center font-bold">Status</th>
                                @canany(['product_edit', 'product_delete'])
                                    <th class="px-6 py-4 text-right font-bold">
                                        Actions
                                    </th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse ($products as $product)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $product->id }}</td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900 dark:text-white">
                                            {{ $product->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if ($product->image)
                                                <img class="mr-3 h-10 w-10 rounded-md object-cover"
                                                    src="{{ asset('storage/' . $product->image) }}" alt="">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                        {{ $product->category->name ?? 'Uncategorized' }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="{{ $product->status ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' }} rounded-full px-2 py-1 text-xs font-semibold">
                                            {{ $product->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    @canany(['product_edit', 'product_delete'])
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end space-x-3">
                                                @can('product_edit')
                                                    <a class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:border-gray-500 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                                                        href="{{ route('admin.products.edit', $product) }}"> <svg
                                                            class="mr-1 h-3 w-3" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            </path>
                                                        </svg>Edit</a>
                                                @endcan

                                                @can('product_delete')
                                                    <form action="{{ route('admin.products.destroy', $product) }}"
                                                        method="POST" onsubmit="return confirm('Delete this product?');">
                                                        @csrf @method('DELETE')
                                                        <button
                                                            class="inline-flex items-center rounded-lg border border-red-300 bg-white px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 focus:outline-none focus:ring-4 focus:ring-red-200 dark:border-red-900 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-red-900/20 dark:focus:ring-red-900"
                                                            type="submit">
                                                            <svg class="mr-1 h-3 w-3" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                                                    stroke-width="2" stroke-linecap="round"
                                                                    stroke-linejoin="round"></path>
                                                            </svg>
                                                            Delete
                                                        </button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    @endcanany
                                </tr>
                            @empty
                                <tr>
                                    <td class="px-6 py-10 text-center text-gray-500" colspan="6">No products found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="border-t border-gray-700 px-6 py-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

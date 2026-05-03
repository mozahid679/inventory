<div class="overflow-hidden rounded-2xl border border-gray-700 bg-gray-900 shadow-xl">
    <table class="w-full text-left text-sm text-gray-400">
        <thead class="bg-gray-800/50 text-[11px] font-bold uppercase tracking-wider text-gray-500">
            <tr>
                <th class="px-6 py-4">Product Details</th>
                <th class="px-6 py-4 text-center">Category</th>
                <th class="px-6 py-4 text-center">In Stock</th>
                <th class="px-6 py-4 text-center">Status</th>
                <th class="px-6 py-4 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-800">
            @forelse($data as $product)
                <tr class="transition hover:bg-gray-800/30">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex h-10 w-10 items-center justify-center rounded-lg bg-indigo-500/10 text-indigo-400">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div>
                                <div class="font-bold text-white">{{ $product->name }}</div>
                                <div class="text-[10px] text-gray-500">ID:
                                    #{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</div>
                            </div>
                        </div>
                    </td>

                    <td class="px-6 py-4 text-center">
                        <span class="rounded-full bg-gray-800 px-2.5 py-1 text-xs font-medium text-gray-300">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-center">
                        <span
                            class="{{ $product->quantity <= 5 ? 'text-orange-500' : 'text-emerald-400' }} font-mono text-lg font-bold">
                            {{ $product->quantity }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-center">
                        @if ($product->quantity <= 0)
                            <span
                                class="inline-flex items-center gap-1 rounded-md bg-red-500/10 px-2 py-1 text-[10px] font-bold uppercase text-red-500 ring-1 ring-inset ring-red-500/20">
                                Out of Stock
                            </span>
                        @elseif($product->quantity <= 5)
                            <span
                                class="inline-flex items-center gap-1 rounded-md bg-orange-500/10 px-2 py-1 text-[10px] font-bold uppercase text-orange-500 ring-1 ring-inset ring-orange-500/20">
                                Low Stock
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-1 rounded-md bg-emerald-500/10 px-2 py-1 text-[10px] font-bold uppercase text-emerald-500 ring-1 ring-inset ring-emerald-500/20">
                                Healthy
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-4 text-right">
                        <a class="inline-flex items-center gap-1 rounded-lg bg-indigo-600 px-3 py-1.5 text-xs font-bold text-white transition hover:bg-indigo-500"
                            href="{{ route('admin.products.show', $product->id) }}">
                            View Log
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-6 py-20 text-center" colspan="5">
                        <div class="flex flex-col items-center justify-center">
                            <svg class="mb-4 h-12 w-12 text-gray-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <p class="text-lg font-medium text-gray-400">No products found matching those filters.</p>
                            <p class="text-sm text-gray-600">Try adjusting your search or stock status.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

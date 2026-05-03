<table class="w-full border-separate border-spacing-y-2 text-left text-sm">
    <thead class="bg-gray-900/40 text-[10px] uppercase tracking-widest text-gray-500">
        <tr>
            <th class="rounded-l-xl px-4 py-4">SKU / Code</th>
            <th class="px-4 py-4">Product Name</th>
            <th class="px-4 py-4">Category</th>
            <th class="px-4 py-4 text-center">Type</th>
            <th class="px-4 py-4 text-right">Balance</th>
            <th class="rounded-r-xl px-4 py-4 text-center">Health</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $product)
            <tr class="group bg-gray-800/40 transition hover:bg-gray-700/40">
                <td class="rounded-l-xl border-y border-l border-gray-700 px-4 py-4 font-mono font-bold text-indigo-400">
                    {{ $product->sku ?? 'NO-SKU' }}
                </td>

                <td class="border-y border-gray-700 px-4 py-4 font-medium text-white">
                    {{ $product->name }}
                </td>

                <td class="border-y border-gray-700 px-4 py-4 text-gray-400">
                    {{ $product->category->name ?? 'Uncategorized' }}
                </td>

                <td class="border-y border-gray-700 px-4 py-4 text-center">
                    <span
                        class="{{ $product->product_type == 'asset' ? 'border-blue-500/30 text-blue-400 bg-blue-500/5' : 'border-purple-500/30 text-purple-400 bg-purple-500/5' }} rounded border px-2 py-1 text-[10px] font-bold uppercase">
                        {{ $product->product_type }}
                    </span>
                </td>

                <td class="border-y border-gray-700 px-4 py-4 text-right">
                    <span class="{{ $product->stock_quantity < 5 ? 'text-red-500' : 'text-white' }} text-lg font-bold">
                        {{ $product->stock_quantity }}
                    </span>
                </td>

                <td class="rounded-r-xl border-y border-r border-gray-700 px-4 py-4 text-center">
                    @if ($product->stock_quantity <= 0)
                        <i class="fas fa-times-circle text-red-500" title="Out of Stock"></i>
                    @elseif($product->stock_quantity < 5)
                        <i class="fas fa-exclamation-circle text-amber-500" title="Low Stock"></i>
                    @else
                        <i class="fas fa-check-circle text-emerald-500" title="Healthy"></i>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td class="py-20 text-center italic text-gray-500" colspan="6">
                    No products found in the global inventory.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<table class="w-full border-separate border-spacing-y-2 text-left text-sm">
    <thead class="bg-gray-900/40 text-[10px] uppercase tracking-widest text-gray-500">
        <tr>
            <th class="rounded-l-xl px-4 py-4">Consumable Item</th>
            <th class="px-4 py-4">Category</th>
            <th class="px-4 py-4 text-center">Unit Type</th>
            <th class="px-4 py-4 text-right">Current Stock</th>
            <th class="rounded-r-xl px-4 py-4 text-center">Procurement Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $item)
            <tr class="group bg-gray-800/40 transition hover:bg-gray-700/40">
                <!-- Item Info -->
                <td class="rounded-l-xl border-y border-l border-gray-700 px-4 py-4">
                    <div class="font-medium text-white">{{ $item->name }}</div>
                    <div class="text-[10px] text-gray-500">Min. Stock Level: {{ $item->min_stock ?? 5 }}</div>
                </td>

                <!-- Category -->
                <td class="border-y border-gray-700 px-4 py-4 text-gray-400">
                    {{ $item->category->name ?? 'General' }}
                </td>

                <!-- Unit (e.g., Pcs, Reams, Box) -->
                <td class="border-y border-gray-700 px-4 py-4 text-center text-gray-500">
                    {{ $item->unit ?? 'Pcs' }}
                </td>

                <!-- Stock -->
                <td class="border-y border-gray-700 px-4 py-4 text-right">
                    <span
                        class="{{ $item->stock_quantity <= ($item->min_stock ?? 5) ? 'text-red-500' : 'text-white' }} text-lg font-bold">
                        {{ $item->stock_quantity }}
                    </span>
                </td>

                <!-- Status Badge -->
                <td class="rounded-r-xl border-y border-r border-gray-700 px-4 py-4 text-center">
                    @if ($item->stock_quantity <= 0)
                        <span
                            class="rounded-full border border-red-500/20 bg-red-500/10 px-3 py-1 text-[10px] font-bold text-red-500">
                            REPLENISH NOW
                        </span>
                    @elseif($item->stock_quantity <= ($item->min_stock ?? 5))
                        <span
                            class="rounded-full border border-amber-500/20 bg-amber-500/10 px-3 py-1 text-[10px] font-bold text-amber-500">
                            LOW STOCK
                        </span>
                    @else
                        <span
                            class="rounded-full border border-emerald-500/20 bg-emerald-500/10 px-3 py-1 text-[10px] font-bold text-emerald-500">
                            AVAILABLE
                        </span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td class="py-20 text-center italic text-gray-500" colspan="5">
                    No consumable products found.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

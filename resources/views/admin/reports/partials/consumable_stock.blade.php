<table class="w-full border-separate border-spacing-y-2 text-left text-sm">
    <thead class="bg-gray-900/40 text-[10px] uppercase tracking-widest text-gray-500">
        <tr>
            <th class="rounded-l-xl px-4 py-4">Consumable Details</th>
            <th class="px-4 py-4">Category</th>
            <th class="px-4 py-4 text-center">Measurement Unit</th>
            <th class="px-4 py-4 text-center">Alert Threshold</th>
            <th class="px-4 py-4 text-right">Current Balance</th>
            <th class="rounded-r-xl px-4 py-4 text-center">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $item)
            @php
                $isLow = $item->stock_quantity <= ($item->min_stock_level ?? 10);
                $isOut = $item->stock_quantity <= 0;
            @endphp
            <tr class="group bg-gray-800/40 transition hover:bg-gray-700/40">
                <!-- Name & SKU -->
                <td class="rounded-l-xl border-y border-l border-gray-700 px-4 py-4">
                    <div class="font-semibold text-white">{{ $item->name }}</div>
                    <div class="font-mono text-[10px] text-indigo-400">
                        {{ $item->sku ?? 'CONS-' . str_pad($item->id, 4, '0', STR_PAD_LEFT) }}</div>
                </td>

                <!-- Category -->
                <td class="border-y border-gray-700 px-4 py-4 text-gray-400">
                    <span class="flex items-center">
                        <i class="fas fa-tag mr-2 text-[10px] text-gray-600"></i>
                        {{ $item->category->name ?? 'General' }}
                    </span>
                </td>

                <!-- Unit Type -->
                <td class="border-y border-gray-700 px-4 py-4 text-center">
                    <span class="rounded border border-gray-700 bg-gray-900 px-2 py-1 text-xs text-gray-400">
                        {{ $item->unit_type ?? 'Pkt/Pcs' }}
                    </span>
                </td>

                <!-- Alert Threshold -->
                <td class="border-y border-gray-700 px-4 py-4 text-center italic text-gray-500">
                    {{ $item->min_stock_level ?? 10 }} units
                </td>

                <!-- Stock Balance -->
                <td class="border-y border-gray-700 px-4 py-4 text-right">
                    <div class="{{ $isLow ? 'text-red-500' : 'text-white' }} text-lg font-black">
                        {{ number_format($item->stock_quantity) }}
                    </div>
                </td>

                <!-- Status Badge -->
                <td class="rounded-r-xl border-y border-r border-gray-700 px-4 py-4 text-center">
                    @if ($isOut)
                        <span
                            class="rounded-md border border-red-500/30 bg-red-500/20 px-2 py-1 text-[9px] font-bold text-red-500">OUT
                            OF STOCK</span>
                    @elseif($isLow)
                        <span
                            class="rounded-md border border-amber-500/30 bg-amber-500/20 px-2 py-1 text-[9px] font-bold text-amber-500">REORDER</span>
                    @else
                        <span
                            class="rounded-md border border-emerald-500/30 bg-emerald-500/20 px-2 py-1 text-[9px] font-bold text-emerald-400">OK</span>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td class="py-20 text-center" colspan="6">
                    <i class="fas fa-box-open mb-3 text-4xl text-gray-700"></i>
                    <p class="text-gray-500">No consumable stock records found.</p>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

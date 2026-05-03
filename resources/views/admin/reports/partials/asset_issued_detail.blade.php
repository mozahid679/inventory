<table class="w-full border-separate border-spacing-y-2 text-left text-sm">
    <thead class="bg-gray-900/40 text-[10px] uppercase tracking-widest text-gray-500">
        <tr>
            <th class="rounded-l-xl px-4 py-4">Issue Date</th>
            <th class="px-4 py-4">Employee Details</th>
            <th class="px-4 py-4">Asset Issued</th>
            <th class="px-4 py-4 text-center">Qty</th>
            <th class="rounded-r-xl px-4 py-4">Ref. No</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $item)
            <tr class="group bg-gray-800/40 transition hover:bg-gray-700/40">
                <td class="rounded-l-xl border-y border-l border-gray-700 px-4 py-4">
                    <div class="font-medium text-white">
                        {{ $item->requisition->acknowledged_at ? $item->requisition->acknowledged_at->format('d M, Y') : $item->requisition->updated_at->format('d M, Y') }}
                    </div>
                    <div class="text-[10px] italic text-gray-500">
                        {{ $item->requisition->updated_at->format('h:i A') }}
                    </div>
                </td>

                <td class="border-y border-gray-700 px-4 py-4">
                    <div class="flex items-center">
                        <div
                            class="mr-3 flex h-8 w-8 items-center justify-center rounded-full border border-indigo-500/30 bg-indigo-500/20 font-bold text-indigo-400">
                            {{ substr($item->requisition->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="font-semibold text-white">{{ $item->requisition->user->name }}</div>
                            <div class="text-[10px] uppercase tracking-tighter text-gray-500">
                                {{ $item->requisition->user->designation ?? 'Department Staff' }}</div>
                        </div>
                    </div>
                </td>

                <td class="border-y border-gray-700 px-4 py-4">
                    <div class="font-medium text-indigo-300">{{ $item->product->name }}</div>
                    <div class="text-[10px] text-gray-500">Cat: {{ $item->product->category->name ?? 'General' }}</div>
                </td>

                <td class="border-y border-gray-700 px-4 py-4 text-center">
                    <span class="rounded-lg border border-gray-600 bg-gray-900 px-3 py-1 font-bold text-white">
                        {{ $item->quantity }}
                    </span>
                </td>

                <td class="rounded-r-xl border-y border-r border-gray-700 px-4 py-4">
                    <a class="flex items-center gap-1 text-xs text-gray-400 transition hover:text-indigo-400"
                        href="{{ route('admin.requisitions.show', $item->requisition_id) }}">
                        <i class="fas fa-external-link-alt text-[10px]"></i>
                        {{ $item->requisition->requisition_no }}
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td class="py-20 text-center" colspan="5">
                    <div class="flex flex-col items-center">
                        <i class="fas fa-folder-open mb-4 text-5xl text-gray-700"></i>
                        <p class="text-gray-500">No issued assets found for the selected criteria.</p>
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

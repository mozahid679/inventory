<x-layouts.app>
    <div class="p-6">
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <nav class="mb-2 text-sm text-gray-500">
                    <a class="hover:text-indigo-400" href="{{ route('admin.stock-ins.index') }}">Stock Entry</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-300">Challan Details</span>
                </nav>
                <h2 class="flex items-center text-3xl font-bold text-white">
                    <i class="fas fa-clip-board-list mr-3 text-indigo-500"></i>
                    Challan: {{ $stockIn->challan_no }}
                </h2>
            </div>
            <div class="flex gap-3">
                <button
                    class="flex items-center rounded-lg bg-gray-700 px-4 py-2 text-white transition hover:bg-gray-600"
                    onclick="window.print()">
                    <i class="fas fa-print mr-2"></i> Print
                </button>
                <a class="rounded-lg bg-indigo-600 px-4 py-2 text-white transition hover:bg-indigo-700"
                    href="{{ route('admin.stock-ins.index') }}">
                    Back to List
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <div class="space-y-6">
                <div class="rounded-xl border border-gray-700 bg-gray-800 p-6">
                    <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider text-gray-400">Stock In Info</h3>

                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-gray-500">Supplier Name</p>
                            <p class="text-lg font-medium text-white">{{ $stockIn->supplier->name ?? 'N/A' }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4 border-t border-gray-700 pt-4">
                            <div>
                                <p class="text-xs text-gray-500">Received Date</p>
                                <p class="text-white">
                                    {{ \Carbon\Carbon::parse($stockIn->received_at)->format('d M, Y') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Unique SKUs</p>
                                <p class="text-white">{{ $stockIn->items->count() }} Types</p>
                            </div>
                        </div>
                        @if ($stockIn->note)
                            <div class="border-t border-gray-700 pt-4">
                                <p class="text-xs text-gray-500">Notes</p>
                                <p class="mt-1 text-sm italic text-gray-300">{{ $stockIn->note }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="rounded-xl border border-gray-700 bg-gray-800 p-4">
                    <h3 class="mb-4 px-2 text-sm font-semibold uppercase tracking-wider text-gray-400">Document Proof
                    </h3>
                    @if ($stockIn->challan_image)
                        @php
                            $extension = pathinfo($stockIn->challan_image, PATHINFO_EXTENSION);
                            $filePath = asset('storage/' . $stockIn->challan_image);
                        @endphp

                        <div
                            class="group relative block overflow-hidden rounded-lg border border-gray-200 dark:border-gray-700">
                            @if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                {{-- Image Preview --}}
                                <a href="{{ $filePath }}" target="_blank">
                                    <img class="h-48 w-full transform object-cover transition duration-500 group-hover:scale-105"
                                        src="{{ $filePath }}" alt="Challan Image">
                                    <div
                                        class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 transition group-hover:opacity-100">
                                        <span class="text-sm font-medium text-white">
                                            <i class="fas fa-search-plus mr-2"></i> View Full Image
                                        </span>
                                    </div>
                                </a>
                            @elseif (strtolower($extension) === 'pdf')
                                {{-- PDF Preview --}}
                                <div class="relative h-48 w-full bg-gray-100 dark:bg-gray-800">
                                    <iframe class="h-full w-full" src="{{ $filePath }}#toolbar=0"
                                        frameborder="0"></iframe>
                                    <a class="absolute inset-0 flex items-center justify-center bg-black/20 opacity-0 transition group-hover:opacity-100"
                                        href="{{ $filePath }}" target="_blank">
                                        <span
                                            class="rounded bg-white px-3 py-1 text-xs font-bold text-gray-800 shadow-sm">
                                            Open PDF in New Tab
                                        </span>
                                    </a>
                                </div>
                            @else
                                {{-- Generic File Fallback --}}
                                <a class="flex h-48 flex-col items-center justify-center bg-gray-50 dark:bg-gray-900"
                                    href="{{ $filePath }}" target="_blank">
                                    <i class="fas fa-file-alt text-4xl text-gray-400"></i>
                                    <span class="mt-2 text-xs text-gray-500">Download File
                                        ({{ strtoupper($extension) }})</span>
                                </a>
                            @endif
                        </div>
                    @else
                        <div
                            class="flex h-48 items-center justify-center rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-700">
                            <span class="text-sm italic text-gray-400">No document attached</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="overflow-hidden rounded-xl border border-gray-700 bg-gray-800 shadow-sm">
                    <table class="w-full text-left">
                        <thead class="bg-gray-900/40">
                            <tr class="text-xs uppercase tracking-widest text-gray-400">
                                <th class="px-6 py-4 font-medium">SL</th>
                                <th class="px-6 py-4 font-medium">Product Description</th>
                                <th class="px-6 py-4 text-center font-medium">Received Quantity</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @foreach ($stockIn->items as $index => $item)
                                <tr class="transition hover:bg-gray-700/20">
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-white">{{ $item->product->name }}</div>
                                        <div class="mt-0.5 text-xs text-gray-500">
                                            Category: {{ $item->product->category->name ?? 'N/A' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span
                                            class="inline-block rounded border border-green-500/20 bg-green-500/10 px-4 py-1 font-bold text-green-400">
                                            {{ $item->quantity }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-900/40">
                            <tr>
                                <td class="px-6 py-4 text-right font-medium text-gray-400" colspan="2">Total Units
                                    Received:</td>
                                <td class="px-6 py-4 text-center text-lg font-bold text-white">
                                    {{ $stockIn->items->sum('quantity') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

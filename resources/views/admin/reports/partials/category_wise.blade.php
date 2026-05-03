<div class="space-y-8">
    @forelse($data as $categoryName => $products)
        <div class="overflow-hidden rounded-xl border border-gray-700">
            <div class="flex items-center justify-between bg-gray-700/50 px-4 py-3">
                <h3 class="flex items-center font-bold text-indigo-400">
                    <i class="fas fa-folder-open mr-2"></i> {{ $categoryName }}
                </h3>
                <span
                    class="rounded-md border border-gray-600 bg-gray-800 px-2 py-1 text-[10px] font-bold uppercase tracking-widest text-gray-400">
                    {{ $products->count() }} Items
                </span>
            </div>

            <table class="w-full text-left text-sm">
                <thead class="bg-gray-900/20 text-[10px] uppercase tracking-widest text-gray-500">
                    <tr>
                        <th class="px-4 py-3">Asset Name</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-right">Current Stock</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700/50">
                    @foreach ($products as $product)
                        <tr class="transition hover:bg-gray-700/20">
                            <td class="px-4 py-3 font-medium text-white">{{ $product->name }}</td>
                            <td class="px-4 py-3 text-center">
                                @if ($product->stock_quantity <= 0)
                                    <span class="text-[9px] font-bold text-red-500">OUT OF STOCK</span>
                                @elseif($product->stock_quantity < 5)
                                    <span class="text-[9px] font-bold text-amber-500">LOW STOCK</span>
                                @else
                                    <span class="text-[9px] font-bold text-emerald-500">HEALTHY</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                <span
                                    class="{{ $product->stock_quantity < 5 ? 'text-amber-500' : 'text-white' }} font-bold">
                                    {{ $product->stock_quantity }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @empty
        <div class="py-20 text-center">
            <i class="fas fa-search mb-4 text-5xl text-gray-700"></i>
            <p class="italic text-gray-500">No assets found with the selected filters.</p>
        </div>
    @endforelse
</div>

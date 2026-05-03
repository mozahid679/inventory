<table class="w-full text-left text-sm text-gray-300">
    <thead class="border-b border-gray-700 text-xs uppercase text-gray-500">
        <tr>
            <th class="px-2 py-3">Asset Name</th>
            <th class="px-2 py-3">Category</th>
            <th class="px-2 py-3 text-right">Available Stock</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-700">
        @foreach ($data as $product)
            <tr class="hover:bg-gray-700/20">
                <td class="px-2 py-4 font-medium text-white">{{ $product->name }}</td>
                <td class="px-2 py-4">{{ $product->category->name }}</td>
                <td class="px-2 py-4 text-right">
                    <span class="{{ $product->stock_quantity < 5 ? 'text-red-500 font-bold' : '' }}">
                        {{ $product->stock_quantity }}
                    </span>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

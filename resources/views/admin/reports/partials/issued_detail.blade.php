<table class="w-full text-left text-sm text-gray-300">
    <thead class="border-b border-gray-700 text-xs uppercase text-gray-500">
        <tr>
            <th class="px-2 py-3">Issue Date</th>
            <th class="px-2 py-3">Employee</th>
            <th class="px-2 py-3">Item Name</th>
            <th class="px-2 py-3 text-center">Qty</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-700">
        @foreach ($data as $item)
            <tr class="hover:bg-gray-700/20">
                <td class="px-2 py-4">{{ $item->requisition->acknowledged_at->format('d M, Y') }}</td>
                <td class="px-2 py-4 text-white">{{ $item->requisition->user->name }}</td>
                <td class="px-2 py-4">{{ $item->product->name }}</td>
                <td class="px-2 py-4 text-center">{{ $item->quantity }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

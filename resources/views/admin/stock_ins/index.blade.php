<x-layouts.app>
    <div class="p-6">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Stock Entry History (Challans)</h2>
            <a class="rounded-lg bg-indigo-600 px-4 py-2 text-white shadow hover:bg-indigo-700"
                href="{{ route('admin.stock-ins.create') }}">
                + New Stock Entry
            </a>
        </div>

        <div
            class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow dark:border-gray-700 dark:bg-gray-800">
            <table class="w-full text-left">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr class="text-sm uppercase text-gray-500 dark:text-gray-300">
                        <th class="p-4">Date</th>
                        <th class="p-4">Challan No</th>
                        <th class="p-4">Supplier</th>
                        <th class="p-4 text-center">Items</th>
                        <th class="p-4">Challan Image/PDF</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($stockIns as $entry)
                        <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="p-4 text-gray-900 dark:text-white">
                                {{ \Carbon\Carbon::parse($entry->received_at)->format('d M, Y') }}
                            </td>
                            <td class="p-4 font-mono text-sm text-indigo-600 dark:text-indigo-400">
                                {{ $entry->challan_no }}
                            </td>
                            <td class="p-4 text-gray-600 dark:text-gray-400">
                                {{ $entry->supplier->name ?? 'N/A' }}
                            </td>
                            <td class="p-4 text-center">
                                <span class="rounded bg-gray-100 px-2 py-1 text-xs dark:bg-gray-600">
                                    {{ $entry->items_count }} Items
                                </span>
                            </td>
                            <td class="p-4">
                                @if ($entry->challan_image)
                                    <a class="text-sm text-blue-500 hover:underline"
                                        href="{{ asset('storage/' . $entry->challan_image) }}" target="_blank">
                                        View File
                                    </a>
                                @else
                                    <span class="text-xs italic text-gray-400">No Image</span>
                                @endif
                            </td>
                            <td class="p-4 text-right">
                                <a class="px-2 text-gray-500 hover:text-indigo-600"
                                    href="{{ route('admin.stock-ins.show', $entry) }}">
                                    Details
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="p-8 text-center text-gray-500" colspan="6">
                                No stock entries found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $stockIns->links() }}
        </div>
    </div>
</x-layouts.app>

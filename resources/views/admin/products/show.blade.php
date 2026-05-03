<x-layouts.app>
    <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">

        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                    Product Details: {{ $product->name }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Category: {{ $product->category?->name ?? 'No Category' }}
                </p>
            </div>

            <button
                class="rounded-lg border px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
                onclick="window.history.back()">
                ← Back
            </button>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

            <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                <h3 class="text-sm font-medium uppercase text-gray-500">Total Stock In</h3>

                <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                    {{ $product->stockInItems->sum('quantity') }}
                </p>
            </div>

            <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                <h3 class="text-sm font-medium uppercase text-gray-500">Suppliers</h3>

                <div class="mt-3 space-y-1 text-sm text-gray-700 dark:text-gray-300">
                    @foreach ($product->stockInItems->pluck('stockIn.supplier')->unique('id') as $supplier)
                        <div>• {{ $supplier->name ?? 'Unknown Supplier' }}</div>
                    @endforeach
                </div>
            </div>

            <div class="rounded-lg bg-white p-6 shadow dark:bg-gray-800">
                <h3 class="text-sm font-medium uppercase text-gray-500">Total Challans</h3>

                <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                    {{ $product->stockInItems->map(fn($i) => $i->stockIn->id)->unique()->count() }}
                </p>
            </div>

        </div>

        <div class="overflow-hidden rounded-lg bg-white shadow dark:bg-gray-800">

            <div class="border-b p-6 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Stock In History
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead class="bg-gray-50 text-xs uppercase text-gray-500 dark:bg-gray-700/50">
                        <tr>
                            <th class="px-6 py-3">Challan</th>
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3">Quantity</th>
                            <th class="px-6 py-3">Supplier</th>
                            <th class="px-6 py-3">Approved By</th>
                            <th class="px-6 py-3">Added By</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y dark:divide-gray-700">

                        @foreach ($product->stockInItems as $item)
                            <tr>

                                <td class="px-6 py-4 font-medium text-blue-600">
                                    #{{ $item->stockIn->challan_no }}
                                </td>

                                <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                    {{ $item->stockIn->received_at }}
                                </td>

                                <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">
                                    {{ $item->quantity }}
                                </td>

                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">
                                    {{ $item->stockIn->supplier->name ?? 'N/A' }}
                                </td>

                                <td class="px-6 py-4 text-gray-700 dark:text-gray-300">
                                    {{ $item->stockIn->approver->name ?? 'System' }}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>

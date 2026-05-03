<x-layouts.app>
    <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
        <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    {{ __('Supplier Details') }}: {{ $supplier->name }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">Viewing comprehensive supply history and contact info</p>
            </div>

            <div class="flex items-center gap-3">
                <button
                    class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-xs font-medium uppercase tracking-widest text-gray-700 shadow-sm transition duration-150 ease-in-out hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700"
                    onclick="window.history.back()">
                    <i class="fas fa-arrow-left mr-2"></i>
                    {{ __('Back') }}
                </button>

                <a class="inline-flex items-center rounded-lg border border-transparent bg-indigo-600 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white shadow-md shadow-indigo-200 transition duration-150 ease-in-out hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-indigo-900 dark:shadow-none"
                    href="{{ route('admin.suppliers.index') }}">
                    <i class="fas fa-users mr-2"></i>
                    {{ __('All Suppliers') }}
                </a>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                <div class="bg-white p-6 shadow sm:rounded-lg dark:bg-gray-800">
                    <h3 class="text-sm font-medium uppercase text-gray-500">Contact Information</h3>
                    <div class="mt-4 space-y-3">
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <i class="fas fa-envelope w-6 text-blue-500"></i> {{ $supplier->email }}
                        </div>
                        <div class="flex items-center text-gray-700 dark:text-gray-300">
                            <i class="fas fa-phone w-6 text-blue-500"></i> {{ $supplier->phone }}
                        </div>
                        <div class="flex items-start text-gray-700 dark:text-gray-300">
                            <i class="fas fa-map-marker-alt mt-1 w-6 text-blue-500"></i> {{ $supplier->address }}
                        </div>
                    </div>
                </div>

                <div class="border-l-4 border-green-500 bg-white p-6 shadow sm:rounded-lg dark:bg-gray-800">
                    <h3 class="text-sm font-medium uppercase text-gray-500">Total Items Supplied</h3>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        {{ number_format($supplier->stockIns->sum(fn($s) => $s->items->sum('quantity'))) }}
                    </p>
                    <p class="mt-1 text-xs text-gray-500">Sum of all approved & pending challans</p>
                </div>

                <div class="border-l-4 border-blue-500 bg-white p-6 shadow sm:rounded-lg dark:bg-gray-800">
                    <h3 class="text-sm font-medium uppercase text-gray-500">Total Deliveries (Challans)</h3>
                    <p class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">
                        {{ $supplier->stockIns->count() }}
                    </p>
                    <p class="mt-1 text-xs text-gray-500">Total unique shipments received</p>
                </div>
            </div>

            <div class="overflow-hidden bg-white shadow sm:rounded-lg dark:bg-gray-800">
                <div class="border-b border-gray-100 p-6 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Supply History</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-xs uppercase text-gray-500 dark:bg-gray-700/50">
                            <tr>
                                <th class="px-6 py-3">Challan No</th>
                                <th class="px-6 py-3">Date Received</th>
                                <th class="px-6 py-3">Items</th>
                                <th class="px-6 py-3">Total Qty</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            @foreach ($supplier->stockIns()->latest()->get() as $stock)
                                <tr>
                                    <td class="px-6 py-4 font-medium text-blue-600 dark:text-blue-400">
                                        #{{ $stock->challan_no }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($stock->received_at)->format('d M, Y') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-xs text-gray-500">
                                            @foreach ($stock->items as $item)
                                                <span class="block">• {{ $item->product->name }}
                                                    ({{ $item->quantity }})
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-900 dark:text-white">
                                        {{ $stock->items->sum('quantity') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($stock->status == 1)
                                            <span
                                                class="rounded-full bg-green-100 px-2 py-1 text-[10px] font-bold uppercase text-green-700">Approved</span>
                                        @else
                                            <span
                                                class="rounded-full bg-yellow-100 px-2 py-1 text-[10px] font-bold uppercase text-yellow-700">Pending</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a class="text-gray-400 hover:text-blue-500"
                                            href="{{ route('admin.stock-ins.show', $stock->id) }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-layouts.app>

{{-- <x-layouts.app>
    <div class="p-6">
        <div class="mb-8">
            <h2 class="flex items-center text-3xl font-bold text-white">
                <i class="fas fa-chart-pie mr-3 text-indigo-500"></i>
                Inventory Reports
            </h2>
            <p class="mt-1 text-sm text-gray-400">Real-time overview of stock levels and movement.</p>
        </div>

        <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-2xl border border-gray-700 bg-gray-800 p-5 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Total Items</p>
                        <h3 class="mt-1 text-2xl font-bold text-white">{{ $totalProducts }}</h3>
                    </div>
                    <div class="rounded-xl bg-indigo-500/20 p-3 text-indigo-500">
                        <i class="fas fa-box-open text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-700 bg-gray-800 p-5 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Total Stock Sum</p>
                        <h3 class="mt-1 text-2xl font-bold text-white">{{ $totalStockValue }}</h3>
                    </div>
                    <div class="rounded-xl bg-emerald-500/20 p-3 text-emerald-500">
                        <i class="fas fa-warehouse text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-l-4 border-gray-700 border-l-red-500 bg-gray-800 p-5 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Low Stock Alerts</p>
                        <h3 class="mt-1 text-2xl font-bold text-red-500">{{ $lowStockCount }}</h3>
                    </div>
                    <div class="rounded-xl bg-red-500/20 p-3 text-red-500">
                        <i class="fas fa-exclamation-triangle text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-700 bg-gray-800 p-5 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider text-gray-500">Pending Tasks</p>
                        <h3 class="mt-1 text-2xl font-bold text-amber-500">{{ $pendingRequisitions }}</h3>
                    </div>
                    <div class="rounded-xl bg-amber-500/20 p-3 text-amber-500">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-700 bg-gray-800 shadow-xl">
            <div class="flex items-center justify-between border-b border-gray-700 p-6">
                <h3 class="font-bold text-white">Stock Status by Product</h3>
                <button class="rounded-lg bg-gray-700 px-4 py-2 text-xs text-white transition hover:bg-gray-600"
                    onclick="window.print()">
                    <i class="fas fa-print mr-2"></i> Print Report
                </button>
            </div>
            <table class="w-full text-left">
                <thead class="bg-gray-900/50 text-xs uppercase tracking-widest text-gray-400">
                    <tr>
                        <th class="px-6 py-4">Product Details</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-right">Current Stock</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach ($products as $product)
                        <tr class="transition hover:bg-gray-700/30">
                            <td class="px-6 py-4">
                                <div class="font-medium text-white">{{ $product->name }}</div>
                                <div class="font-mono text-[10px] text-gray-500">{{ $product->sku ?? 'NO-SKU' }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">
                                {{ $product->category->name ?? 'Uncategorized' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if ($product->stock_quantity <= 0)
                                    <span
                                        class="rounded border border-red-500/20 bg-red-500/10 px-2 py-0.5 text-[10px] font-bold uppercase text-red-500">Out
                                        of Stock</span>
                                @elseif($product->stock_quantity < 5)
                                    <span
                                        class="rounded border border-amber-500/20 bg-amber-500/10 px-2 py-0.5 text-[10px] font-bold uppercase text-amber-500">Low
                                        Stock</span>
                                @else
                                    <span
                                        class="rounded border border-emerald-500/20 bg-emerald-500/10 px-2 py-0.5 text-[10px] font-bold uppercase text-emerald-500">Healthy</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <span
                                    class="{{ $product->stock_quantity < 5 ? 'text-red-500' : 'text-white' }} text-lg font-bold">
                                    {{ $product->stock_quantity }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app> --}}

{{-- <x-layouts.app>
    <div class="p-6">
        <div class="flex flex-col gap-8 lg:flex-row">

            <div class="w-full space-y-2 lg:w-72">
                <h3 class="mb-4 px-4 text-xs font-bold uppercase tracking-widest text-gray-500">Report Categories</h3>

                @php
                    $reportList = [
                        'category_wise' => ['icon' => 'fa-tags', 'label' => 'Category Wise Asset'],
                        'issued_detail' => ['icon' => 'fa-external-link-alt', 'label' => 'Asset Issued Detail'],
                        'scrap_damage' => ['icon' => 'fa-dumpster', 'label' => 'Asset Scrap/Damage Detail'],
                        'current_status' => ['icon' => 'fa-info-circle', 'label' => 'Asset Current Status'],
                        'stock_detail' => ['icon' => 'fa-warehouse', 'label' => 'Asset Stock Detail'],
                        'order_detail' => ['icon' => 'fa-shopping-cart', 'label' => 'Consumable Order Detail'],
                        'consumable_sum' => ['icon' => 'fa-list-alt', 'label' => 'Consumable Summary'],
                        'supplier_info' => ['icon' => 'fa-truck-loading', 'label' => 'Supplier Information'],
                        'cons_stock' => ['icon' => 'fa-cubes', 'label' => 'Consumable Stock Detail'],
                    ];
                @endphp

                @foreach ($reportList as $key => $report)
                    <a class="{{ $type == $key ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }} flex items-center rounded-xl px-4 py-3 transition"
                        href="{{ route('admin.reports.index', ['type' => $key]) }}">
                        <i class="fas {{ $report['icon'] }} w-6"></i>
                        <span class="text-sm font-medium">{{ $report['label'] }}</span>
                    </a>
                @endforeach
            </div>

            <div class="flex-1 overflow-hidden rounded-2xl border border-gray-700 bg-gray-800 shadow-2xl">
                <div class="flex items-center justify-between border-b border-gray-700 bg-gray-900/30 p-6">
                    <div>
                        <h2 class="text-xl font-bold text-white">{{ $reportList[$type]['label'] }}</h2>
                        <p class="mt-1 text-xs text-gray-500">Generated on {{ now()->format('d M, Y h:i A') }}</p>
                    </div>
                    <button class="rounded-lg bg-gray-700 px-4 py-2 text-xs text-white transition hover:bg-gray-600"
                        onclick="window.print()">
                        <i class="fas fa-file-pdf mr-2 text-red-500"></i> Export PDF
                    </button>
                </div>

                <div class="p-6">
                    @include('admin.reports.partials.' . $type)
                </div>
            </div>
        </div>
    </div>
</x-layouts.app> --}}


<x-layouts.app>
    <div class="p-6">
        <div class="flex flex-col gap-6 lg:flex-row">

            <div class="w-full flex-shrink-0 lg:w-72">
                <div class="sticky top-6 rounded-2xl border border-gray-700 bg-gray-800 p-4 shadow-xl">
                    <h3 class="mb-4 px-2 text-xs font-bold uppercase tracking-widest text-gray-500">Report Selection
                    </h3>
                    <nav class="space-y-1">
                        @php
                            $reports = [
                                'category_wise' => 'Category Wise Asset',
                                'issued_detail' => 'Asset Issued Detail',
                                'scrap_damage' => 'Scrap/Damage Detail',
                                'current_status' => 'Asset Current Status',
                                'stock_detail' => 'Asset Stock Detail',
                                'order_detail' => 'Consumable Orders',
                                'consumable_sum' => 'Consumable Summary',
                                'supplier_info' => 'Supplier Information',
                                'cons_stock' => 'Consumable Stock',
                            ];
                        @endphp
                        @foreach ($reports as $key => $label)
                            <a class="{{ $type == $key ? 'bg-indigo-600 text-white shadow-lg' : 'text-gray-400 hover:bg-gray-700 hover:text-gray-200' }} flex items-center rounded-xl px-4 py-2.5 text-sm transition"
                                href="{{ route('admin.reports.index', $key) }}">
                                {{ $label }}
                            </a>
                        @endforeach
                    </nav>
                </div>
            </div>

            <div class="flex-1">
                <div class="overflow-hidden rounded-2xl border border-gray-700 bg-gray-800 shadow-xl">
                    <div class="flex items-center justify-between border-b border-gray-700 bg-gray-900/20 p-6">
                        <h2 class="text-xl font-bold text-white">{{ $reports[$type] }}</h2>
                        <button
                            class="rounded-lg bg-indigo-600 px-4 py-2 text-xs font-bold text-white transition hover:bg-indigo-700"
                            onclick="window.print()">
                            <i class="fas fa-print mr-2"></i> Print Report
                        </button>
                    </div>

                    <div class="overflow-x-auto p-6">
                        @include('admin.reports.partials.' . $type)
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

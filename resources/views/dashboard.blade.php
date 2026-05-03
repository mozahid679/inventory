<x-layouts.app>
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Inventory Overview</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">Real-time status of your organizational assets.</p>
            </div>
            <div
                class="rounded-full bg-emerald-50 px-3 py-1 text-sm font-medium text-emerald-600 dark:bg-emerald-900/30">
                System Online: {{ now()->format('d M, Y') }}
            </div>
        </div>

        <div class="mb-8 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Total Assets</p>
                        <h3 class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalAssets }}</h3>
                    </div>
                    <div class="rounded-lg bg-blue-50 p-3 dark:bg-blue-900/20">
                        <i class="fas fa-boxes-stacked text-xl text-blue-600"></i>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-sm text-blue-600">
                    <a class="hover:underline" href="{{ route('admin.products.index') }}">View details →</a>
                </div>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Active Suppliers</p>
                        <h3 class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalSuppliers }}</h3>
                    </div>
                    <div class="rounded-lg bg-emerald-50 p-3 dark:bg-emerald-900/20">
                        <i class="fas fa-truck-field text-xl text-emerald-600"></i>
                    </div>
                </div>
                <div class="mt-4 text-xs text-gray-400">Managing {{ $totalCategories }} categories</div>
            </div>

            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wider text-gray-500">Total Users</p>
                        <h3 class="mt-1 text-3xl font-bold text-gray-900 dark:text-white">{{ $totalUsers }}</h3>
                    </div>
                    <div class="rounded-lg bg-indigo-50 p-3 dark:bg-indigo-900/20">
                        <i class="fas fa-users text-xl text-indigo-600"></i>
                    </div>
                </div>
                <div class="mt-4 text-xs text-gray-400">Managing {{ $totalRoles }} roles</div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
            <div class="rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="border-b border-gray-100 p-5 dark:border-gray-700">
                    <h3 class="font-bold text-gray-800 dark:text-white">Recently Added Assets</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead
                            class="border-b border-gray-100 text-[10px] font-bold uppercase tracking-wider text-gray-400 dark:border-gray-800">
                            <tr>
                                <th class="px-4 py-3">Asset & Challan</th>
                                <th class="px-4 py-3">Supplier</th>
                                <th class="px-4 py-3 text-right">Qty Received</th>
                                <th class="px-4 py-3 text-right">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                            @foreach ($recentAssets as $item)
                                <tr class="transition-colors hover:bg-gray-50 dark:hover:bg-white/5">
                                    <td class="px-4 py-4">
                                        <div class="font-semibold text-gray-900 dark:text-white">
                                            {{ $item->product->name }}
                                        </div>
                                        <div class="flex items-center gap-1 text-xs text-gray-500">
                                            <i class="fas fa-file-invoice text-[10px]"></i>
                                            <span>#{{ $item->stockIn->challan_no }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4">
                                        <a class="group"
                                            href="{{ route('admin.suppliers.show', $item->stockIn->supplier->id) }}">
                                            <span
                                                class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700 transition-colors group-hover:bg-blue-100 dark:bg-blue-900/20 dark:text-blue-400 dark:group-hover:bg-blue-800/30">
                                                <i
                                                    class="fas fa-external-link-alt mr-1 text-[9px] opacity-0 transition-opacity group-hover:opacity-100"></i>
                                                {{ $item->stockIn->supplier->name ?? 'N/A' }}
                                            </span>
                                        </a>
                                    </td>
                                    <td class="px-4 py-4 text-right">
                                        <span class="font-mono font-bold text-green-600 dark:text-green-400">
                                            +{{ number_format($item->quantity) }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-4 text-right text-xs text-gray-400">
                                        {{ $item->created_at->format('M d, Y') }}
                                        <span
                                            class="block text-[10px] opacity-70">{{ $item->created_at->diffForHumans() }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>

            <div class="rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="border-b border-gray-100 p-5 dark:border-gray-700">
                    <h3 class="font-bold text-gray-800 dark:text-white">Quick Management</h3>
                </div>
                <div class="grid grid-cols-2 gap-4 p-6">
                    <a class="flex flex-col items-center justify-center rounded-lg border border-dashed border-gray-300 bg-gray-50 p-4 transition hover:bg-blue-50 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-blue-900/30"
                        href="{{ route('admin.products.create') }}">
                        <i class="fas fa-plus mb-2 text-blue-500"></i>
                        <span class="text-xs font-semibold dark:text-gray-200">New Product</span>
                    </a>
                    <a class="flex flex-col items-center justify-center rounded-lg border border-dashed border-gray-300 bg-gray-50 p-4 transition hover:bg-purple-50 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-purple-900/30"
                        href="{{ route('admin.permissions.index') }}">
                        <i class="fas fa-shield-halved mb-2 text-purple-500"></i>
                        <span class="text-xs font-semibold dark:text-gray-200">Security Access</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

<x-layouts.app>
    <div class="p-6">
        <div class="mb-6 rounded-2xl border border-gray-700 bg-gray-800 p-6 shadow-xl">
            <form class="grid grid-cols-1 gap-4 md:grid-cols-4" action="{{ url()->current() }}" method="GET">

                <div>
                    <label class="mb-1 block px-2 py-1.5 text-[10px] font-bold uppercase text-gray-500">Asset
                        Search</label>
                    <input
                        class="w-full rounded-xl border-gray-700 bg-gray-900 px-4 py-2 text-sm text-white focus:ring-indigo-500"
                        name="search" type="text" value="{{ request('search') }}" placeholder="Name...">
                </div>

                <div>
                    <label class="mb-1 block px-2 py-1.5 text-[10px] font-bold uppercase text-gray-500">Category</label>
                    <select
                        class="w-full rounded-xl border-gray-700 bg-gray-900 px-4 py-2 text-sm text-white focus:ring-indigo-500"
                        name="category_id">
                        <option value="">All Categories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="mb-1 block px-2 py-1.5 text-[10px] font-bold uppercase text-gray-500">Status</label>
                    <select
                        class="w-full rounded-xl border-gray-700 bg-gray-900 px-4 py-2 text-sm text-white focus:ring-indigo-500"
                        name="stock_status">
                        <option value="">All Stock</option>
                        <option value="low" @selected(request('stock_status') == 'low')>Low (< 5)</option>
                        <option value="out" @selected(request('stock_status') == 'out')>Out of Stock</option>
                    </select>
                </div>

                <div>
                    <label class="mb-1 block px-2 py-1.5 text-[10px] font-bold uppercase text-gray-500">Types</label>
                    <select
                        class="w-full rounded-xl border-gray-700 bg-gray-900 px-4 py-2 text-sm text-white focus:ring-indigo-500"
                        name="product_type">
                        <option value="">All Types</option>
                        <option value="asset" @selected(request('product_type') == 'asset')>Assets Only</option>
                        <option value="consumable" @selected(request('product_type') == 'consumable')>Consumables Only</option>
                    </select>
                </div>

                <div class="flex items-end gap-2">
                    <button
                        class="flex-1 rounded-xl bg-indigo-600 py-2 text-sm font-bold text-white transition hover:bg-indigo-700"
                        type="submit">
                        <i class="fas fa-filter mr-2"></i> Apply
                    </button>
                    <a class="flex items-center rounded-xl bg-gray-700 px-4 py-2 text-white transition hover:bg-gray-600"
                        href="{{ url()->current() }}">
                        <i class="fas fa-undo"></i>
                    </a>
                </div>
            </form>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-700 bg-gray-800 shadow-xl">
            <div class="flex items-center justify-between border-b border-gray-700 bg-gray-900/30 p-6">
                <h2 class="text-xl font-bold uppercase tracking-tight text-white">
                    {{ ucwords(str_replace('_', ' ', $type)) }} Asset Report</h2>
                <button class="rounded-lg bg-gray-700 px-4 py-2 text-xs text-white transition hover:bg-gray-600"
                    onclick="window.print()">
                    <i class="fas fa-print mr-2"></i> Print Report
                </button>
            </div>

            <div class="p-6">
                @include('admin.reports.partials.' . $type)
            </div>
        </div>
    </div>
</x-layouts.app>

<x-layouts.app>
    <div class="p-6" x-data="requisitionForm()">
        <div class="mb-8">
            <h2 class="flex items-center text-3xl font-bold text-white">
                <i class="fas fa-file-signature mr-3 text-indigo-500"></i>
                Create Requisition
            </h2>
            <p class="mt-1 text-sm text-gray-400">Submit a request for items from the inventory.</p>
        </div>

        <form action="{{ route('admin.requisitions.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">

                <div class="space-y-6 lg:col-span-1">
                    <div class="rounded-2xl border border-gray-700 bg-gray-800 p-6 shadow-xl">
                        <h3 class="mb-4 text-sm font-semibold uppercase tracking-wider text-gray-400">Request Info</h3>

                        <div class="space-y-4">
                            <div>
                                <label class="mb-1 block text-sm font-medium text-gray-400">Title / Purpose *</label>
                                <input
                                    class="w-full rounded-lg border-gray-600 bg-gray-700 px-4 py-2.5 text-white focus:ring-indigo-500"
                                    name="title" type="text" required placeholder="e.g., Monthly Office Supplies">
                            </div>

                            <div>
                                <label class="mb-1 block text-sm font-medium text-gray-400">Detailed Description</label>
                                <textarea class="w-full rounded-lg border-gray-600 bg-gray-700 px-4 py-2.5 text-white focus:ring-indigo-500"
                                    name="description" rows="4" placeholder="Explain why you need these items..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6 lg:col-span-2">
                    <div class="rounded-2xl border border-gray-700 bg-gray-800 p-6 shadow-xl">
                        <div class="mb-6 flex items-center justify-between">
                            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-400">Requested Items
                            </h3>
                            <button
                                class="rounded-lg border border-indigo-500/30 bg-indigo-600/20 px-3 py-1.5 text-xs text-indigo-400 transition hover:bg-indigo-600 hover:text-white"
                                type="button" @click="addItem()">
                                <i class="fas fa-plus mr-1"></i> Add Row
                            </button>
                        </div>

                        <table class="w-full">
                            <thead>
                                <tr
                                    class="border-b border-gray-700 text-left text-xs uppercase tracking-widest text-gray-500">
                                    <th class="px-2 pb-3">Product</th>
                                    <th class="w-32 px-2 pb-3">Quantity</th>
                                    <th class="w-10 px-2 pb-3"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                <template x-for="(item, index) in items" :key="index">
                                    <tr>
                                        <td class="px-2 py-4">
                                            <select
                                                class="w-full rounded-lg border-gray-600 bg-gray-700 px-3 py-2 text-sm text-white focus:ring-indigo-500"
                                                :name="`items[${index}][product_id]`" x-model="item.product_id"
                                                @change="
            let selected = $event.target.options[$event.target.selectedIndex];
            item.max_stock = selected.dataset.stock;
            if(parseInt(item.quantity) > parseInt(item.max_stock)) item.quantity = item.max_stock;
        "
                                                required>
                                                <option value="">Select Product</option>
                                                @foreach ($products as $product)
                                                    <option data-stock="{{ $product->stock_quantity }}"
                                                        value="{{ $product->id }}">
                                                        {{ $product->name }} (Available: {{ $product->stock_quantity }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td class="px-2 py-4">
                                            <div class="space-y-1">
                                                <input
                                                    class="w-full rounded-lg border-gray-600 bg-gray-700 px-3 py-2 text-center text-sm text-white focus:ring-indigo-500"
                                                    type="number"
                                                    :class="parseInt(item.quantity) > parseInt(item.max_stock) ?
                                                        'border-red-500 ring-1 ring-red-500' : ''"
                                                    :name="`items[${index}][quantity]`" x-model="item.quantity"
                                                    min="1" :max="item.max_stock" required>

                                                <template x-if="parseInt(item.quantity) > parseInt(item.max_stock)">
                                                    <p class="text-[10px] text-red-400">Max available: <span
                                                            x-text="item.max_stock"></span></p>
                                                </template>
                                            </div>
                                        </td>
                                        <td class="px-2 py-4 text-right">
                                            <button class="text-gray-500 transition hover:text-red-500" type="button"
                                                @click="removeItem(index)" x-show="items.length > 1">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>

                        <div class="mt-8 flex justify-end gap-3">
                            <a class="rounded-xl px-6 py-2.5 text-gray-400 transition hover:text-white"
                                href="{{ route('admin.requisitions.index') }}">Cancel</a>
                            <button
                                class="rounded-xl bg-indigo-600 px-8 py-2.5 font-bold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-700"
                                type="submit">
                                Submit Requisition
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script>
        function requisitionForm() {
            return {
                items: [{
                    product_id: '',
                    quantity: 1
                }],
                addItem() {
                    this.items.push({
                        product_id: '',
                        quantity: 1
                    });
                },
                removeItem(index) {
                    this.items.splice(index, 1);
                }
            }
        }
    </script>
</x-layouts.app>

<x-layouts.app>
    <div class="p-6" x-data="stockInForm()">

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-red-100 p-4 text-red-700 dark:bg-red-900/30 dark:text-red-300">
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.stock-ins.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <!-- LEFT -->
                <div class="space-y-4 lg:col-span-1">
                    <div
                        class="rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
                        <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-200">
                            Challan Details
                        </h3>

                        <div class="space-y-4">

                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">Supplier
                                    *</label>
                                <select
                                    class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    name="supplier_id" required>
                                    <option value="">Select Supplier</option>
                                    @foreach ($suppliers as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">Challan No
                                    *</label>
                                <input
                                    class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    name="challan_no" type="text" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">Received Date
                                    *</label>
                                <input
                                    class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    name="received_at" type="date" value="{{ date('Y-m-d') }}" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-300">Challan
                                    Image</label>
                                <input
                                    class="mt-1 w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    name="challan_image" type="file">
                            </div>

                        </div>
                    </div>
                </div>

                <!-- RIGHT -->
                <div class="lg:col-span-2">
                    <div
                        class="rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">

                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                Products in this Challan
                            </h3>

                            <button class="rounded bg-green-600 px-3 py-1.5 text-sm text-white hover:bg-green-700"
                                type="button" @click="addItem()">
                                + Add Row
                            </button>
                        </div>

                        <table class="w-full text-left">
                            <thead>
                                <tr
                                    class="border-b border-gray-200 text-sm text-gray-500 dark:border-gray-700 dark:text-gray-400">
                                    <th class="px-2 py-2">Product</th>
                                    <th class="w-24 px-2 py-2">Qty</th>
                                    <th class="w-10 px-2 py-2"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <template x-for="(item, index) in items" :key="index">
                                    <tr class="border-b border-gray-200 dark:border-gray-700">

                                        <!-- PRODUCT -->
                                        <td class="px-2 py-3">
                                            <div class="relative w-full" x-data="{ loading: false }">

                                                <!-- Loader -->
                                                <div class="absolute right-3 top-1/2 -translate-y-1/2" x-show="loading"
                                                    x-transition>
                                                    <svg class="h-4 w-4 animate-spin text-blue-500 dark:text-blue-400"
                                                        viewBox="0 0 24 24">
                                                        <circle class="opacity-20" cx="12" cy="12" r="10"
                                                            stroke="currentColor" stroke-width="4"></circle>
                                                        <path class="opacity-80" fill="currentColor"
                                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                                    </svg>
                                                </div>

                                                <select class="hidden" x-init="loading = true;
                                                $nextTick(() => {
                                                    new TomSelect($el, {
                                                        create: false,
                                                        placeholder: '🔍 Search product...',
                                                        maxOptions: 100,

                                                        onInitialize() {
                                                            loading = false;

                                                            this.wrapper.className = `ts-wrapper w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        text-sm shadow-sm
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        focus-within:ring-2 focus-within:ring-blue-500
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    `;

                                                            this.control.className = `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ts-control flex items-center px-3 py-2 bg-transparent
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        text-gray-800 dark:text-gray-100
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    `;

                                                            this.dropdown.className = `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ts-dropdown mt-2 rounded-lg border
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        border-gray-200 dark:border-gray-700
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        bg-white dark:bg-gray-800 shadow-lg
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    `;
                                                        }
                                                    });
                                                });"
                                                    :name="`items[${index}][product_id]`" required>

                                                    <option value="">Select Product</option>

                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}">
                                                            {{ $product->name }} |
                                                            {{ $product->category?->name ?? 'No Category' }} -
                                                            {{ $product->category->categoryType->name ?? 'No Type' }} ||
                                                            (In Stock: {{ $product->stock_quantity }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>

                                        <!-- QTY -->
                                        <td class="px-2 py-3">
                                            <input
                                                class="w-full rounded border border-gray-300 bg-white px-2 py-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                                type="number" min="1" :max="item.max_qty"
                                                x-model.number="item.quantity"
                                                @input="if (item.quantity > item.max_qty) item.quantity = item.max_qty"
                                                :name="`items[${index}][quantity]`" required />
                                        </td>

                                        <!-- REMOVE -->
                                        <td class="px-2 py-3">
                                            <button class="text-red-500 hover:text-red-700" type="button"
                                                @click="removeItem(index)">
                                                &times;
                                            </button>
                                        </td>

                                    </tr>
                                </template>
                            </tbody>
                        </table>

                        <!-- NOTE -->
                        <div class="mt-4">
                            <label class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Notes
                            </label>
                            <input
                                class="w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                name="note" type="text" x-model="note">
                        </div>

                        <!-- ACTION -->
                        <div class="mt-6 flex justify-end gap-4">
                            <a class="rounded-lg border border-gray-300 px-5 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
                                href="{{ route('admin.stock-ins.index') }}">
                                Cancel
                            </a>

                            <button
                                class="rounded-lg bg-blue-600 px-8 py-2 font-bold text-white shadow hover:bg-blue-700 disabled:opacity-50"
                                type="submit">
                                Post Stock Entry
                            </button>
                        </div>

                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- Alpine -->
    <script>
        function stockInForm() {
            return {
                items: [{
                    product_id: '',
                    quantity: 1,
                    max_qty: 0
                }],
                note: '',

                addItem() {
                    this.items.push({
                        product_id: '',
                        quantity: 1
                    });
                },

                removeItem(index) {
                    if (this.items.length > 1) {
                        this.items.splice(index, 1);
                    }
                }
            }
        }
    </script>

    <!-- TomSelect -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

</x-layouts.app>

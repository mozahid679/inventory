<x-layouts.app>
    <div class="p-6" x-data="stockInForm()">
        <form action="{{ route('admin.stock-ins.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
                <div class="space-y-4 lg:col-span-1">
                    <div
                        class="rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
                        <h3 class="mb-4 text-lg font-semibold text-gray-700 dark:text-gray-200">Challan Details</h3>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-400">Supplier *</label>
                                <select
                                    class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 px-2 py-1.5 text-white"
                                    name="supplier_id" required>
                                    <option value="">Select Supplier</option>
                                    @foreach ($suppliers as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-400">Challan No *</label>
                                <input
                                    class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 px-2 py-1.5 text-white"
                                    name="challan_no" type="text" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-400">Received Date *</label>
                                <input
                                    class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 px-2 py-1.5 text-white"
                                    name="received_at" type="date" value="{{ date('Y-m-d') }}" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-400">Challan Image</label>
                                <input
                                    class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 px-2 py-1.5 text-white"
                                    name="challan_image" type="file">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div
                        class="rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800">
                        <div class="mb-4 flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Products in this Challan
                            </h3>
                            <button class="rounded bg-green-600 px-3 py-1 text-sm text-white hover:bg-green-700"
                                type="button" @click="addItem()">
                                + Add Row
                            </button>
                        </div>

                        <table class="w-full border-collapse text-left">
                            <thead>
                                <tr class="border-b border-gray-700 text-sm text-gray-400">
                                    <th class="px-2 py-2">Product</th>
                                    <th class="w-24 px-2 py-2">Qty</th>
                                    <th class="w-10 px-2 py-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(item, index) in items" :key="index">
                                    <tr class="border-b border-gray-700">
                                        <td class="px-2 py-3">
                                            <div class="relative w-full" x-data="{ loading: false }">

                                                <!-- Loader -->
                                                <div class="pointer-events-none absolute right-3 top-1/2 z-20 -translate-y-1/2"
                                                    x-show="loading" x-transition>
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
                                                    const ts = new TomSelect($el, {
                                                        create: false,
                                                        placeholder: '🔍 Search product...',
                                                        maxOptions: 100,

                                                        onInitialize() {
                                                            loading = false;

                                                            // Wrapper
                                                            this.wrapper.className = `
                                                                                                                                                                                                                                                                                                                                                                            ts-wrapper w-full rounded-xl border border-gray-300
                                                                                                                                                                                                                                                                                                                                                                            bg-white text-sm shadow-sm transition-all
                                                                                                                                                                                                                                                                                                                                                                            focus-within:ring-4 focus-within:ring-blue-500/10 focus-within:border-blue-500
                                                                                                                                                                                                                                                                                                                                                                            dark:bg-gray-900 dark:border-gray-600
                                                                                                                                                                                                                                                                                                                                                                        `;

                                                            // Control (input area)
                                                            this.control.className = `
                                                                                                                                                                                                                                                                                                                                                                            ts-control flex items-center gap-2 px-4 py-2.5 bg-transparent
                                                                                                                                                                                                                                                                                                                                                                            text-gray-800 dark:text-gray-100
                                                                                                                                                                                                                                                                                                                                                                        `;

                                                            // Dropdown
                                                            this.dropdown.className = `
                                                                                                                                                                                                                                                                                                                                                                            ts-dropdown mt-2 rounded-xl border border-gray-200 shadow-lg
                                                                                                                                                                                                                                                                                                                                                                            bg-white overflow-hidden
                                                                                                                                                                                                                                                                                                                                                                            dark:bg-gray-900 dark:border-gray-700
                                                                                                                                                                                                                                                                                                                                                                        `;
                                                        },

                                                        render: {
                                                            option(data, escape) {
                                                                const name = data.text.split('(')[0];
                                                                const meta = data.text.includes('(') ?
                                                                    data.text.split('(')[1].replace(')', '') :
                                                                    '';

                                                                return `
                                                                                                                                                                                                                                                                                                                                                                                <div class='cursor-pointer px-4 py-2 text-gray-800 hover:bg-blue-50 dark:text-gray-100 dark:hover:bg-gray-800'>
                                                                                                                                                                                                                                                                                                                                                                                    <div class='font-medium'>${escape(name)}</div>
                                                                                                                                                                                                                                                                                                                                                                                    <div class='text-xs text-gray-500 dark:text-gray-400'>
                                                                                                                                                                                                                                                                                                                                                                                        ${escape(meta)}
                                                                                                                                                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                            `;
                                                            },

                                                            item(data, escape) {
                                                                return `
                                                                                                                                                                                                                                                                                                                                                                                <div class='text-gray-800 dark:text-gray-100'>
                                                                                                                                                                                                                                                                                                                                                                                    ${escape(data.text)}
                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                                            `;
                                                            },

                                                            dropdown() {
                                                                return `<div class='ts-dropdown'></div>`;
                                                            }
                                                        }
                                                    });
                                                });"
                                                    :name="`items[${index}][product_id]`" required>
                                                    <option value="">{{ __('Select a Product') }}</option>

                                                    @foreach ($products as $product)
                                                        <option value="{{ $product->id }}">
                                                            {{ $product->name }}
                                                            ({{ $product->category?->name ?? 'N/A' }} -
                                                            {{ $product->category?->categoryType?->name ?? 'N/A' }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                        <td class="px-2 py-3">
                                            <input
                                                class="w-full rounded border-gray-300 bg-white px-2 py-1.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                                type="number" :name="`items[${index}][quantity]`"
                                                x-model="item.quantity" required min="1">
                                        </td>
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

                        <div class="mt-6 flex justify-end gap-4">
                            <a class="rounded-lg border border-gray-600 px-5 py-2.5 text-sm font-medium text-gray-300 hover:bg-gray-700"
                                href="{{ route('admin.stock-ins.index') }}">
                                Cancel
                            </a>
                            <button
                                class="rounded-lg bg-blue-600 px-8 py-2 font-bold text-white shadow-lg transition hover:bg-blue-700"
                                type="submit">
                                Post Stock Entry
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function stockInForm() {
            return {
                items: [{
                    product_id: '',
                    quantity: 1,
                    unit_cost: ''
                }],
                addItem() {
                    this.items.push({
                        product_id: '',
                        quantity: 1,
                        unit_cost: ''
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

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

    <style>
        /* Fix for Dark Mode Tailwind */
        .ts-control {
            background-color: #374151 !important;
            color: white !important;
            border: 1px solid #4b5563 !important;
        }

        .ts-dropdown {
            background-color: #374151 !important;
            color: white !important;
        }

        .ts-dropdown .active {
            background-color: #1d4ed8 !important;
            color: white !important;
        }

        .ts-dropdown .option {
            color: #d1d5db;
        }
    </style>
</x-layouts.app>

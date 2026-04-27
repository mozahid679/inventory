<x-layouts.app>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="border-l-4 border-blue-500 pl-4">
                <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">
                    {{ __('Editing') }} <span class="font-medium text-gray-500 dark:text-gray-400">/</span>
                    <span class="text-blue-600 dark:text-blue-400">{{ $product->name }}</span>
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">Modify product details and permissions</p>
            </div>
            <a class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-gray-600 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                href="{{ route('admin.products.index') }}">
                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Inventory
            </a>
        </div>
    </div>

    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                    <div class="space-y-6 lg:col-span-2">
                        <div class="grid grid-cols-2 gap-4 bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800">
                            <div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-300">Category *</label>
                                    <select
                                        class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 px-2 py-1.5 text-white"
                                        name="category_id" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-300">Product Name *</label>
                                    <input
                                        class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 px-2 py-1.5 text-white focus:ring-blue-500"
                                        name="name" type="text" value="{{ old('name', $product->name) }}"
                                        required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-300">Description</label>
                                <textarea class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 px-2 py-1.5 text-white focus:ring-blue-500"
                                    name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800">
                            <div class="mt-6 bg-white p-2 shadow-sm sm:rounded-lg dark:bg-gray-700">
                                <label class="flex cursor-pointer items-center">
                                    <input class="h-4 w-4 rounded border-gray-600 bg-gray-700 text-blue-500"
                                        name="status" type="checkbox" value="1"
                                        {{ $product->status ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm font-medium text-gray-300">Product Active</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800">
                            <label class="mb-2 block text-sm font-medium text-gray-300">Product Image</label>

                            @if ($product->image)
                                <div class="mb-4">
                                    <img class="h-24 w-full rounded-lg border border-gray-600 object-cover"
                                        src="{{ asset('storage/' . $product->image) }}">
                                    <p class="mt-1 text-xs text-gray-500">Current Image</p>
                                </div>
                            @endif

                            <input
                                class="block w-full text-sm text-gray-400 file:mr-4 file:rounded-full file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-700"
                                name="image" type="file">
                        </div>

                        <button
                            class="w-full rounded-lg bg-blue-600 py-3 font-bold text-white transition hover:bg-blue-700"
                            type="submit">
                            Update Product
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>

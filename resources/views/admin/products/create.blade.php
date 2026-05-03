<x-layouts.app>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Add New Product</h2>
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                    <div class="space-y-6 lg:col-span-2">

                        <div class="grid grid-cols-2 gap-4 bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-300">Category *</label>
                                <select
                                    class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 px-2 py-1.5 text-white focus:ring-blue-500"
                                    name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }} ({{ $category->categoryType?->name ?? 'No Type' }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-300">Product Name *</label>
                                <input
                                    class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 px-2 py-1.5 text-white focus:ring-blue-500"
                                    name="name" type="text" value="{{ old('name') }}" required>
                                @error('name')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-300">Description</label>
                                <textarea class="mt-1 block w-full rounded-lg border-gray-600 bg-gray-700 px-2 py-1.5 text-white focus:ring-blue-500"
                                    name="description" rows="2">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center shadow-sm sm:rounded-lg">
                                <label class="flex cursor-pointer items-center bg-white dark:bg-gray-800">
                                    <input name="status" type="hidden" value="0">
                                    <input
                                        class="h-4 w-4 rounded border-gray-600 bg-gray-700 text-blue-600 focus:ring-blue-500"
                                        name="status" type="checkbox" value="1"
                                        {{ old('status', '1') == '1' ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm font-medium text-gray-300">Active (Visible in
                                        Store)</span>
                                    @error('status')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="bg-white p-6 shadow-sm sm:rounded-lg dark:bg-gray-800">
                            <label class="mb-2 block text-sm font-medium text-gray-300">Product Image
                                <span class="text-xs text-gray-500 dark:text-gray-400">(Optional)</span></label>
                            <input
                                class="block w-full text-sm text-gray-400 file:mr-4 file:rounded-full file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-blue-700"
                                name="image" type="file">
                            @error('image')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div
                            class="mt-6 flex flex-col items-center justify-end gap-3 border-t border-gray-100 pt-6 sm:flex-row dark:border-gray-800">
                            <!-- Cancel Link: Subtle Ghost/Glass Style -->
                            <a class="inline-flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-6 py-2.5 text-sm font-medium text-gray-600 transition-all duration-200 hover:bg-gray-50 hover:text-gray-900 active:scale-95 sm:w-auto dark:border-gray-700 dark:bg-transparent dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white"
                                href="{{ route('admin.products.index') }}">
                                Cancel
                            </a>

                            <!-- Submit Button: Modern High-Contrast Style -->
                            <button
                                class="inline-flex w-full items-center justify-center rounded-lg bg-gray-900 px-8 py-2.5 text-sm font-semibold text-white transition-all duration-200 hover:bg-gray-800 focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 active:scale-95 sm:w-auto dark:bg-emerald-600 dark:hover:bg-emerald-500 dark:focus:ring-emerald-500"
                                type="submit">
                                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Publish Product
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>

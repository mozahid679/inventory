<x-layouts.app>
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ __('Edit Category') }}: {{ $category->name }}
            </h2>
            <a class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
                href="{{ route('admin.categories.index') }}">
                &larr; Back to List
            </a>
        </div>
    </div>

    <div class="py-12">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-sm sm:rounded-lg dark:bg-gray-800">
                <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-6 grid grid-cols-1 gap-6 md:grid-cols-2">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category Name
                                *</label>
                            <input
                                class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-2 py-1.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                name="name" type="text" value="{{ old('name', $category->name) }}" required>
                            @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Product Type
                                *</label>
                            <select
                                class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-2 py-1.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                name="product_type_id" required>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ $category->product_type_id == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                            <textarea
                                class="mt-1 block w-full rounded-lg border-gray-300 bg-gray-50 px-2 py-1.5 text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                        </div>
                        <div>
                            <label class="mt-4 flex cursor-pointer items-center bg-gray-700 px-4 py-2">
                                <input
                                    class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700"
                                    name="status" type="checkbox" value="1"
                                    {{ $category->status ? 'checked' : '' }}>
                                <span class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Active
                                    Category</span>
                            </label>
                            <hr class="my-3 bg-gray-400">
                            <div class="flex justify-end space-x-3">
                                <a class="rounded-lg border border-gray-300 px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700"
                                    href="{{ route('admin.categories.index') }}">
                                    Cancel
                                </a>
                                <button
                                    class="rounded-lg bg-blue-600 px-2 py-2 text-sm font-medium text-white hover:bg-blue-700"
                                    type="submit">
                                    Update Category
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layouts.app>

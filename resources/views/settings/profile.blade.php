<x-layouts.app>
    <!-- Breadcrumbs -->
    <div class="mb-6 flex items-center text-sm">
        <a class="text-blue-600 hover:underline dark:text-blue-400"
            href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
        <svg class="mx-2 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <a class="text-blue-600 hover:underline dark:text-blue-400"
            href="{{ route('settings.profile.edit') }}">{{ __('Profile') }}</a>
        <svg class="mx-2 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-500 dark:text-gray-400">{{ __('Profile') }}</span>
    </div>

    <!-- Page Title -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ __('Profile') }}</h1>
        <p class="mt-1 text-gray-600 dark:text-gray-400">{{ __('Update your name and email address') }}</p>
    </div>

    <div class="p-6">
        <div class="flex flex-col gap-6 md:flex-row">
            <!-- Sidebar Navigation -->
            @include('settings.partials.navigation')

            <!-- Profile Content -->
            <div class="flex-1">
                <div
                    class="mb-6 overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                    <div class="p-6">
                        <!-- Profile Form -->
                        <form class="mb-10 max-w-md" action="{{ route('settings.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>

                                <div class="mb-4">
                                    <x-forms.input name="name" type="text" value="{{ old('name', $user->name) }}"
                                        label="Name" />
                                </div>

                                <div class="mb-4">
                                    <x-forms.input name="designation" type="text"
                                        value="{{ old('designation', $user->designation) }}" label="Designation" />
                                </div>

                                <div class="mb-6">
                                    <x-forms.input name="email" type="email"
                                        value="{{ old('email', $user->email) }}" label="Email" />
                                </div>

                                <div class="mb-6">
                                    <x-forms.input name="phone" type="text"
                                        value="{{ old('phone', $user->phone_no) }}" label="Phone" />
                                </div>

                                <div class="mb-6">
                                    <x-forms.input name="address" type="text"
                                        value="{{ old('address', $user->address) }}" label="Address" />
                                </div>
                            </div>


                            <div>
                                <x-button type="primary">{{ __('Save') }}</x-button>
                            </div>
                        </form>

                        <!-- Delete Account Section -->
                        <div class="mt-6 border-t border-gray-200 pt-6 dark:border-gray-700">
                            <h2 class="mb-1 text-lg font-medium text-gray-800 dark:text-gray-200">
                                {{ __('Delete account') }}
                            </h2>
                            <p class="mb-4 text-gray-600 dark:text-gray-400">
                                {{ __('Delete your account and all of its resources') }}
                            </p>
                            <form action="{{ route('settings.profile.destroy') }}" method="POST"
                                onsubmit="return confirm('{{ __('Are you sure you want to delete your account?') }}')">
                                @csrf
                                @method('DELETE')
                                <x-button type="danger">{{ __('Delete account') }}</x-button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

            <aside
                class="bg-sidebar text-sidebar-foreground sidebar-transition overflow-hidden border-r border-gray-200 dark:border-gray-700"
                :class="{ 'w-full md:w-64': sidebarOpen, 'w-0 md:w-16 hidden md:block': !sidebarOpen }">
                <!-- Sidebar Content -->
                <div class="flex h-full flex-col">
                    <!-- Sidebar Menu -->
                    <nav class="custom-scrollbar flex-1 overflow-y-auto py-4">
                        <ul class="space-y-1 px-2">

                            <div>
                                <h3
                                    class="my-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Main Navigation
                                </h3>

                                <x-layouts.sidebar-link href="{{ route('dashboard') }}" icon='fas-house'
                                    :active="request()->routeIs('dashboard*')">
                                    Dashboard
                                </x-layouts.sidebar-link>
                            </div>

                            <div class="gap-2">
                                <h3
                                    class="my-3 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                    Catalog Management
                                </h3>
                                <x-layouts.sidebar-link href="{{ route('admin.suppliers.index') }}"
                                    icon='fas-truck-field' :active="request()->routeIs('admin.suppliers*')">
                                    Suppliers
                                </x-layouts.sidebar-link>

                                @can('role_management_access')
                                    <x-layouts.sidebar-link href="{{ route('admin.product-types.index') }}" icon='fas-tags'
                                        :active="request()->routeIs('admin.product-types*')">
                                        Category Type(s)
                                    </x-layouts.sidebar-link>
                                @endcan

                                <x-layouts.sidebar-link href="{{ route('admin.categories.index') }}"
                                    icon='fas-layer-group' :active="request()->routeIs('admin.categories*')">
                                    Categories
                                </x-layouts.sidebar-link>

                                <x-layouts.sidebar-link href="{{ route('admin.products.index') }}" icon='fas-box'
                                    :active="request()->routeIs('admin.products*')">
                                    Products
                                </x-layouts.sidebar-link>

                                <x-layouts.sidebar-link href="{{ route('admin.stock-ins.index') }}"
                                    icon="fas-file-invoice" :active="request()->routeIs('admin.stock-ins*')">
                                    Product Stock
                                </x-layouts.sidebar-link>
                            </div>

                            {{-- Requisitions Section --}}
                            {{-- <div class="mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                Inventory Flow
                            </div>

                            <x-layouts.sidebar-link href="{{ route('admin.requisitions.index') }}"
                                icon="fas-file-invoice" :active="request()->routeIs('admin.requisitions.*')">
                                @role('Employee')
                                    My Requisitions
                                @else
                                    All Requisitions
                                @endrole

                                @role(['Store Keeper', 'Approval Authority (IT)', 'Approval Authority (Non-IT)'])
                                    @php $pendingCount = \App\Models\Requisition::whereIn('status', [0, 1])->count(); @endphp
                                    @if ($pendingCount > 0)
                                        <span
                                            class="ml-auto animate-pulse rounded-full bg-amber-600 px-1.5 py-0.5 text-[10px] text-white">
                                            {{ $pendingCount }}
                                        </span>
                                    @endif
                                @endrole
                            </x-layouts.sidebar-link> --}}


                            <div class="space-y-2">
                                <p class="py-4 text-xs font-semibold uppercase tracking-wider text-gray-500">
                                    Inventory Flow
                                </p>

                                {{-- 1. My Requisitions: Visible to Everyone --}}
                                <x-layouts.sidebar-link
                                    href="{{ route('admin.requisitions.index', ['filter' => 'mine']) }}"
                                    icon='fas-truck-field' :active="request()->get('filter') == 'mine'">

                                    My Requisitions
                                </x-layouts.sidebar-link>

                                {{-- 2. All Requisitions: Visible only to specific Roles --}}
                                @role([
                                    'Store Keeper',
                                    'Approval Authority (IT)',
                                    'Approval Authority (Non-IT)',
                                    'System
                                    Admin',
                                    'admin',
                                    ])
                                    <x-layouts.sidebar-link href="{{ route('admin.requisitions.index') }}"
                                        icon="fas-file-invoice" :active="request()->routeIs('admin.requisitions.index') &&
                                            !request()->has('filter')">
                                        All Requisitions
                                    </x-layouts.sidebar-link>
                                @endrole
                            </div>


                            <!-- Example two level -->
                            <x-layouts.sidebar-two-level-link-parent title="Reports" icon="fas-house" :active="request()->routeIs('admin.reports.*')">
                                <x-layouts.sidebar-two-level-link href="{{ route('admin.reports.category_wise') }}"
                                    icon='fas-house' :active="request()->routeIs('admin.reports.category_wise*')">Category Wise</x-layouts.sidebar-two-level-link>

                                <x-layouts.sidebar-two-level-link
                                    href="{{ route('admin.reports.asset_issued_detail') }}" icon='fas-house'
                                    :active="request()->routeIs('admin.reports.asset_issued_detail*')">Asset Issued Detail</x-layouts.sidebar-two-level-link>

                                <x-layouts.sidebar-two-level-link href="{{ route('admin.reports.product_wise') }}"
                                    icon='fas-house' :active="request()->routeIs('admin.reports.product_wise*')">Product Wise</x-layouts.sidebar-two-level-link>

                                <x-layouts.sidebar-two-level-link href="{{ route('admin.reports.supplier_wise') }}"
                                    icon='fas-house' :active="request()->routeIs('admin.reports.supplier_wise*')">Supplier Wise</x-layouts.sidebar-two-level-link>

                                <x-layouts.sidebar-two-level-link
                                    href="{{ route('admin.reports.asset_current_status') }}" icon='fas-house'
                                    :active="request()->routeIs('admin.reports.asset_current_status*')">Asset Current Status</x-layouts.sidebar-two-level-link>

                                <x-layouts.sidebar-two-level-link
                                    href="{{ route('admin.reports.consumable_summary') }}" icon='fas-house'
                                    :active="request()->routeIs('admin.reports.consumable_summary*')">Consumable Summary</x-layouts.sidebar-two-level-link>


                                <x-layouts.sidebar-two-level-link href="{{ route('admin.reports.consumable_stock') }}"
                                    icon='fas-house' :active="request()->routeIs('admin.reports.consumable_stock*')">Consumable
                                    Stock</x-layouts.sidebar-two-level-link>

                            </x-layouts.sidebar-two-level-link-parent>




                            @role('Super Admin')
                                <x-layouts.sidebar-link href="{{ route('admin.users.index') }}" icon="fas-users-cog">
                                    User Management
                                </x-layouts.sidebar-link>
                            @endrole


                            @canany(['role_management_access', 'permission_management_access',
                                'user_management_access'])
                                <div class="gap-2">
                                    <h3
                                        class="my-2 mt-4 text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                                        Management
                                    </h3>

                                    @can('role_management_access')
                                        <x-layouts.sidebar-link href="{{ route('admin.roles.index') }}" icon='fas-list'
                                            :active="request()->routeIs('admin.roles.*')">
                                            Roles
                                        </x-layouts.sidebar-link>
                                    @endcan
                                    @can('permission_management_access')
                                        <x-layouts.sidebar-link href="{{ route('admin.permissions.index') }}" icon='fas-key'
                                            :active="request()->routeIs('admin.permissions.*')">
                                            Permissions
                                        </x-layouts.sidebar-link>
                                    @endcan

                                    @can('user_management_access')
                                        <x-layouts.sidebar-link href="{{ route('admin.users.index') }}" icon='fas-users'
                                            :active="request()->routeIs('admin.users.*')">
                                            Users
                                        </x-layouts.sidebar-link>
                                    @endcan
                                </div>
                            @endcanany



                            {{-- <!-- Example three level -->
                            <x-layouts.sidebar-two-level-link-parent title="Example three level" icon="fas-house"
                                :active="request()->routeIs('three-level*')">
                                <x-layouts.sidebar-two-level-link href="#" icon='fas-house'
                                    :active="request()->routeIs('three-level*')">Single Link</x-layouts.sidebar-two-level-link>

                                <x-layouts.sidebar-three-level-parent title="Third Level" icon="fas-house"
                                    :active="request()->routeIs('three-level*')">
                                    <x-layouts.sidebar-three-level-link href="#" :active="request()->routeIs('three-level*')">
                                        Third Level Link
                                    </x-layouts.sidebar-three-level-link>
                                </x-layouts.sidebar-three-level-parent>
                            </x-layouts.sidebar-two-level-link-parent> --}}
                        </ul>
                    </nav>
                </div>
            </aside>

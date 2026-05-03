<x-layouts.app>
    <div class="p-6">
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <div class="flex items-center gap-3">
                    <a class="text-gray-500 transition hover:text-white" href="{{ route('admin.requisitions.index') }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h2 class="text-3xl font-bold uppercase tracking-tight text-white">
                        {{ $requisition->requisition_no }}
                    </h2>
                </div>
                <p class="ml-7 mt-1 text-sm text-gray-400">Submitted by {{ $requisition->user->name }} on
                    {{ $requisition->created_at->format('d M, Y - h:i A') }}</p>
            </div>

            <div class="flex items-center gap-3">
                @php
                    $colors = [
                        0 => 'bg-amber-500/10 text-amber-500 border-amber-500/50',
                        1 => 'bg-blue-500/10 text-blue-500 border-blue-500/50',
                        2 => 'bg-green-500/10 text-green-500 border-green-500/50',
                        3 => 'bg-red-500/10 text-red-500 border-red-500/50',
                        4 => 'bg-indigo-500/10 text-indigo-500 border-indigo-500/50',
                    ];
                @endphp
                <span
                    class="{{ $colors[$requisition->status] }} rounded-full border px-4 py-1.5 text-xs font-bold uppercase tracking-widest">
                    {{ $requisition->status_label }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2">
                <div class="rounded-2xl border border-gray-700 bg-gray-800 p-6 shadow-xl">
                    <h3 class="mb-2 text-lg font-bold text-white">{{ $requisition->title }}</h3>
                    <p class="leading-relaxed text-gray-400">{{ $requisition->description }}</p>
                </div>

                <div class="overflow-hidden rounded-2xl border border-gray-700 bg-gray-800 shadow-xl">
                    <div class="border-b border-gray-700 p-6">
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-400">Requested Items</h3>
                    </div>
                    <table class="w-full text-left">
                        <thead class="bg-gray-900/50 text-xs uppercase tracking-widest text-gray-500">
                            <tr>
                                <th class="px-6 py-3">Product Name</th>
                                <th class="px-6 py-3 text-center">Qty</th>
                                <th class="px-6 py-3">Current Stock</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @foreach ($requisition->items as $item)
                                <tr class="text-sm text-gray-300">
                                    <td class="px-6 py-4 font-medium text-white">{{ $item->product->name }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="rounded-md bg-gray-700 px-3 py-1">{{ $item->quantity }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="{{ $item->product->stock_quantity < $item->quantity ? 'text-red-500' : 'text-gray-500' }}">
                                            {{ $item->product->stock_quantity }} available
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-2xl border border-gray-700 bg-gray-800 p-6 shadow-xl">
                    <h3 class="mb-6 text-sm font-semibold uppercase tracking-wider text-gray-400">Workflow Actions</h3>

                    <div class="space-y-4">
                        {{-- Action 1: Review (Store Keeper) --}}
                        @if ($requisition->status == 0)
                            @role('Store Keeper')
                                <form action="{{ route('admin.requisitions.review', $requisition) }}" method="POST">
                                    @csrf
                                    <button
                                        class="w-full rounded-xl bg-amber-600 py-3 font-bold text-white shadow-lg shadow-amber-600/20 transition hover:bg-amber-700"
                                        type="submit">
                                        <i class="fas fa-search mr-2"></i> Confirm Review (OK)
                                    </button>
                                </form>
                            @else
                                <p class="text-center text-xs italic italic text-gray-500">Waiting for Store Keeper
                                    review...</p>
                            @endrole
                        @endif

                        {{-- Action 2: Approval (Authorities) --}}
                        @if ($requisition->status == 1)
                            @role(['Approval Authority (IT)', 'Approval Authority (Non-IT)'])
                                <form action="{{ route('admin.requisitions.approve', $requisition) }}" method="POST">
                                    @csrf
                                    <button
                                        class="w-full rounded-xl bg-green-600 py-3 font-bold text-white shadow-lg shadow-green-600/20 transition hover:bg-green-700"
                                        type="submit">
                                        <i class="fas fa-check-double mr-2"></i> Approve & Dispatch
                                    </button>
                                </form>
                            @else
                                <p class="text-center text-xs italic italic text-gray-500">Waiting for Final Approval...</p>
                            @endrole
                        @endif

                        {{-- Action 3: Acknowledge (Requested User) --}}
                        @if ($requisition->status == 2 && auth()->id() == $requisition->user_id)
                            <form action="{{ route('admin.requisitions.acknowledge', $requisition) }}" method="POST">
                                @csrf
                                <button
                                    class="w-full rounded-xl bg-indigo-600 py-3 font-bold text-white shadow-lg shadow-indigo-600/20 transition hover:bg-indigo-700"
                                    type="submit">
                                    <i class="fas fa-hand-holding-box mr-2"></i> Acknowledge Receipt
                                </button>
                            </form>
                        @endif

                        @if ($requisition->status == 4)
                            <div class="rounded-xl border border-indigo-500/30 bg-indigo-500/10 p-4 text-center">
                                <i class="fas fa-check-circle mb-2 text-2xl text-indigo-400"></i>
                                <p class="text-sm font-medium text-indigo-300">Requisition Completed & Acknowledged</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="rounded-2xl border border-gray-700 bg-gray-800 p-6 shadow-xl">
                    <h3 class="mb-6 text-sm font-semibold uppercase tracking-wider text-gray-400">Tracking Details</h3>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="mt-1"><i class="fas fa-user-edit text-gray-500"></i></div>
                            <div>
                                <p class="text-xs uppercase text-gray-500">Requester</p>
                                <p class="text-sm font-medium text-white">{{ $requisition->user->name }}</p>
                            </div>
                        </div>

                        @if ($requisition->reviewer)
                            <div class="flex items-start gap-3">
                                <div class="mt-1"><i class="fas fa-search text-amber-500"></i></div>
                                <div>
                                    <p class="text-xs uppercase text-gray-500">Reviewed By</p>
                                    <p class="text-sm font-medium text-white">{{ $requisition->reviewer->name }}</p>
                                    <p class="text-[10px] text-gray-500">
                                        {{ $requisition->reviewed_at->format('d M, Y') }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($requisition->approver)
                            <div class="flex items-start gap-3">
                                <div class="mt-1"><i class="fas fa-check-double text-green-500"></i></div>
                                <div>
                                    <p class="text-xs uppercase text-gray-500">Approved By</p>
                                    <p class="text-sm font-medium text-white">{{ $requisition->approver->name }}</p>
                                    <p class="text-[10px] text-gray-500">
                                        {{ $requisition->approved_at->format('d M, Y') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>

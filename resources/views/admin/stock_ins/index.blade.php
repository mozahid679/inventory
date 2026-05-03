<x-layouts.app>
    <div class="p-6">
        <div class="mb-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Stock Entry History (Challans)</h2>
            @can('stock_in-create')
                <a class="rounded-lg bg-indigo-600 px-4 py-2 text-white shadow hover:bg-indigo-700"
                    href="{{ route('admin.stock-ins.create') }}">
                    + New Stock Entry
                </a>
            @endcan
        </div>

        <div
            class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow dark:border-gray-700 dark:bg-gray-800">
            <table class="w-full text-left">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr class="text-sm uppercase text-gray-500 dark:text-gray-300">
                        <th class="p-4">SL</th>
                        <th class="p-4">Received Date</th>
                        <th class="p-4">Challan No</th>
                        <th class="p-4">Supplier</th>
                        <th class="p-4">status</th>
                        <th class="p-4">Challan Image/PDF</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($stockIns as $entry)
                        <tr class="transition hover:bg-gray-50 dark:hover:bg-gray-700/50">
                            <td class="p-4 text-gray-900 dark:text-white">
                                {{ $loop->iteration }}
                            </td>
                            <td class="p-4 text-gray-900 dark:text-white">
                                {{ \Carbon\Carbon::parse($entry->received_at)->format('d M, Y') }}
                            </td>
                            <td class="p-4 font-mono text-sm text-indigo-600 dark:text-indigo-400">
                                {{ $entry->challan_no }}
                            </td>
                            <td class="p-4 text-gray-600 dark:text-gray-400">
                                {{ $entry->supplier->name ?? 'N/A' }}
                            </td>
                            <td class="p-4">
                                @if ($entry->status == 0)
                                    <span
                                        class="rounded-full border border-amber-200 bg-amber-100 px-2 py-1 text-xs font-semibold text-amber-700 dark:border-amber-800 dark:bg-amber-900/30 dark:text-amber-400">
                                        Pending
                                    </span>
                                @else
                                    <span
                                        class="rounded-full border border-emerald-200 bg-emerald-100 px-2 py-1 text-xs font-semibold text-emerald-700 dark:border-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400">
                                        Approved
                                    </span>
                                @endif
                            </td>
                            <td class="p-4">
                                @if ($entry->challan_image)
                                    <a class="text-sm text-blue-500 hover:underline"
                                        href="{{ asset('storage/' . $entry->challan_image) }}" target="_blank">
                                        View File
                                    </a>
                                @else
                                    <span class="text-xs italic text-gray-400">No Image</span>
                                @endif
                            </td>
                            <td class="flex items-center justify-end gap-4 p-4">
                                <a class="inline-flex items-center gap-2 rounded-md bg-gray-50 px-3 py-2 text-sm font-semibold text-gray-600 ring-1 ring-inset ring-gray-200 transition hover:bg-indigo-50 hover:text-indigo-600 hover:ring-indigo-200 dark:bg-gray-800 dark:text-gray-300 dark:ring-gray-700 dark:hover:bg-indigo-900/30 dark:hover:text-indigo-400"
                                    href="{{ route('admin.stock-ins.show', $entry) }}">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Details
                                </a>

                                <div>
                                    @if ($entry->status == 0)
                                        @if (auth()->user()->hasRole('Approval Authority (IT)') && $entry->isItProduct())
                                            <form action="{{ route('admin.stock-ins.approve', $entry->id) }}"
                                                method="POST">
                                                @csrf
                                                <button
                                                    class="rounded bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-green-700"
                                                    type="submit">
                                                    Approve IT Product Lot
                                                </button>
                                            </form>
                                        @elseif (auth()->user()->hasRole('Approval Authority (Non-IT)') && !$entry->isItProduct())
                                            <form action="{{ route('admin.stock-ins.approve', $entry->id) }}"
                                                method="POST">
                                                @csrf
                                                <button
                                                    class="rounded bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                                                    type="submit">
                                                    Approve Non-IT Product Lot
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs italic text-gray-400">Awaiting Approval</span>
                                        @endif
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 text-xs font-medium text-emerald-600">
                                            <svg class="h-3 w-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Approved
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="p-8 text-center text-gray-500" colspan="6">
                                No stock entries found.
                            </td>
                        </tr>
                    @endforelse

                    {{-- @foreach ($stockIns as $stock)
                        <tr>
                            <td>
                                @if ($stock->status == 0)
                                    @if (auth()->user()->hasRole('Approval Authority (IT)') && $stock->isItProduct())
                                        <form action="{{ route('admin.stock-ins.approve', $stock->id) }}"
                                            method="POST">
                                            @csrf
                                            <button class="rounded bg-green-600 px-3 py-1 text-xs text-white">Approve
                                                IT</button>
                                        </form>
                                    @endif

                                    @if (auth()->user()->hasRole('Approval Authority (Non-IT)') && !$stock->isItProduct())
                                        <form action="{{ route('admin.stock-ins.approve', $stock->id) }}"
                                            method="POST">
                                            @csrf
                                            <button class="rounded bg-blue-600 px-3 py-1 text-xs text-white">Approve
                                                Non-IT</button>
                                        </form>
                                    @endif
                                @else
                                    <span class="text-gray-400">Approved</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $stockIns->links() }}
        </div>
    </div>
</x-layouts.app>

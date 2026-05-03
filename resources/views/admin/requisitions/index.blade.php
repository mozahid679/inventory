<x-layouts.app>
    <div class="p-6">
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h2 class="flex items-center text-3xl font-bold text-white">
                    <i class="fas fa-clipboard-list mr-3 text-indigo-500"></i>
                    Requisitions
                </h2>
                <p class="mt-1 text-sm text-gray-400">Manage and track asset requests across departments.</p>
            </div>

            <a class="flex items-center rounded-xl bg-indigo-600 px-5 py-2.5 font-semibold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-700"
                href="{{ route('admin.requisitions.create') }}">
                <i class="fas fa-plus mr-2"></i> New Request
            </a>
        </div>

        <div class="overflow-hidden rounded-2xl border border-gray-700 bg-gray-800 shadow-xl">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left">
                    <thead>
                        <tr
                            class="border-b border-gray-700 bg-gray-900/50 text-xs uppercase tracking-widest text-gray-400">
                            <th class="px-6 py-4 font-medium">Req. No</th>
                            <th class="px-6 py-4 font-medium">Requested By</th>
                            <th class="px-6 py-4 font-medium">Title & Items</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 text-right font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($requisitions as $req)
                            <tr class="group transition hover:bg-gray-700/30">
                                <td class="px-6 py-4">
                                    <span class="font-mono font-bold text-indigo-400">{{ $req->requisition_no }}</span>
                                    <div class="mt-1 text-[10px] text-gray-500">{{ $req->created_at->format('d M, Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div
                                            class="mr-3 flex h-8 w-8 items-center justify-center rounded-full border border-gray-600 bg-gray-700 text-xs font-bold text-gray-300">
                                            {{ substr($req->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-white">{{ $req->user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $req->user->designation ?? 'Staff' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-200">{{ Str::limit($req->title, 30) }}
                                    </div>
                                    <div class="mt-1 text-xs text-gray-500">
                                        <i class="fas fa-layer-group mr-1"></i> {{ $req->items->count() }} Items
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusConfig = [
                                            0 => [
                                                'bg' => 'bg-amber-500/10',
                                                'text' => 'text-amber-500',
                                                'label' => 'Pending Review',
                                            ],
                                            1 => [
                                                'bg' => 'bg-blue-500/10',
                                                'text' => 'text-blue-500',
                                                'label' => 'Under Approval',
                                            ],
                                            2 => [
                                                'bg' => 'bg-green-500/10',
                                                'text' => 'text-green-500',
                                                'label' => 'Approved',
                                            ],
                                            3 => [
                                                'bg' => 'bg-red-500/10',
                                                'text' => 'text-red-500',
                                                'label' => 'Cancelled',
                                            ],
                                            4 => [
                                                'bg' => 'bg-indigo-500/10',
                                                'text' => 'text-indigo-500',
                                                'label' => 'Acknowledged',
                                            ],
                                        ][$req->status];
                                    @endphp
                                    <span
                                        class="{{ $statusConfig['bg'] }} {{ $statusConfig['text'] }} rounded-full border border-current px-3 py-1 text-[10px] font-bold uppercase tracking-wider opacity-80">
                                        {{ $statusConfig['label'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <a class="rounded-lg bg-gray-700 p-2 text-white transition hover:bg-indigo-600"
                                            href="{{ route('admin.requisitions.show', $req) }}" title="View Details">
                                            <i class="fas fa-eye text-sm"></i>
                                        </a>

                                        {{-- Quick Action Button based on Role & Status --}}
                                        @if ($req->status == 0 && auth()->user()->hasRole('Store Keeper'))
                                            <form action="{{ route('admin.requisitions.review', $req) }}"
                                                method="POST">
                                                @csrf
                                                <button
                                                    class="rounded-lg bg-amber-600 p-2 text-white transition hover:bg-amber-700"
                                                    title="Mark as Reviewed">
                                                    <i class="fas fa-check text-sm"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if (
                                            $req->status == 1 &&
                                                (auth()->user()->hasRole('Approval Authority (IT)') || auth()->user()->hasRole('Approval Authority (Non-IT)')))
                                            <form action="{{ route('admin.requisitions.approve', $req) }}"
                                                method="POST">
                                                @csrf
                                                <button
                                                    class="rounded-lg bg-green-600 p-2 text-white transition hover:bg-green-700"
                                                    title="Final Approve">
                                                    <i class="fas fa-check-double text-sm"></i>
                                                </button>
                                            </form>
                                        @endif

                                        @if ($req->status == 2 && auth()->id() == $req->user_id)
                                            <form action="{{ route('admin.requisitions.acknowledge', $req) }}"
                                                method="POST">
                                                @csrf
                                                <button
                                                    class="rounded-lg bg-indigo-600 p-2 text-white transition hover:bg-indigo-700"
                                                    title="Acknowledge Receipt">
                                                    <i class="fas fa-check-double text-sm"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="px-6 py-12 text-center" colspan="5">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-inbox mb-4 text-5xl text-gray-700"></i>
                                        <p class="text-gray-500">No requisitions found in the system.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($requisitions->hasPages())
                <div class="border-t border-gray-700 bg-gray-900/30 px-6 py-4">
                    {{ $requisitions->links() }}
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>

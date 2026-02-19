<div id="remit-table-content">
    {{-- Results count --}}
    <div class="flex items-center justify-between mb-4">
        <p class="text-sm text-[#8b9cb3]">
            {{ $events->total() }} event{{ $events->total() !== 1 ? 's' : '' }} found
        </p>
    </div>

    {{-- Table --}}
    <div class="rounded-xl border border-[#2d3a4a] overflow-hidden bg-[#1a222d]">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[900px]">
                <thead>
                    <tr class="border-b border-[#2d3a4a] bg-[#0f1419]">
                        @php
                            $sortParams = array_filter(request()->only(['asset', 'status', 'search', 'start_from', 'end_before', 'per_page']), fn($v) => $v !== '' && $v !== null);
                            $currentSort = request('sort', 'start_at');
                            $currentDir = request('direction', 'asc');
                            $sortLink = fn($col, $dir = null) => route('remit.index', array_merge($sortParams, ['sort' => $col, 'direction' => $dir ?? ($currentSort === $col && $currentDir === 'asc' ? 'desc' : 'asc'), 'page' => 1]));
                        @endphp
                        <th class="px-4 py-3 text-left">
                            <a href="{{ $sortLink('asset') }}" class="remit-sort-link flex items-center gap-1 text-xs font-semibold text-[#8b9cb3] hover:text-[#00d4aa] transition-colors uppercase tracking-wider">
                                Asset
                                @if($currentSort === 'asset')
                                    <svg class="w-3 h-3 {{ $currentDir === 'asc' ? '' : 'rotate-180' }}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                @endif
                            </a>
                        </th>
                        <th class="px-4 py-3 text-left">
                            <a href="{{ $sortLink('event_id') }}" class="remit-sort-link flex items-center gap-1 text-xs font-semibold text-[#8b9cb3] hover:text-[#00d4aa] transition-colors uppercase tracking-wider">
                                Event ID
                                @if($currentSort === 'event_id')
                                    <svg class="w-3 h-3 {{ $currentDir === 'asc' ? '' : 'rotate-180' }}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                @endif
                            </a>
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-semibold text-[#8b9cb3] uppercase tracking-wider">Rev</th>
                        <th class="px-4 py-3 text-left">
                            <a href="{{ $sortLink('published_at') }}" class="remit-sort-link flex items-center gap-1 text-xs font-semibold text-[#8b9cb3] hover:text-[#00d4aa] transition-colors uppercase tracking-wider">
                                Published (GMT)
                                @if($currentSort === 'published_at')
                                    <svg class="w-3 h-3 {{ $currentDir === 'asc' ? '' : 'rotate-180' }}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                @endif
                            </a>
                        </th>
                        <th class="px-4 py-3 text-left">
                            <a href="{{ $sortLink('start_at') }}" class="remit-sort-link flex items-center gap-1 text-xs font-semibold text-[#8b9cb3] hover:text-[#00d4aa] transition-colors uppercase tracking-wider">
                                Start (GMT)
                                @if($currentSort === 'start_at')
                                    <svg class="w-3 h-3 {{ $currentDir === 'asc' ? '' : 'rotate-180' }}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                @endif
                            </a>
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-[#8b9cb3] uppercase tracking-wider">End (GMT)</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-[#8b9cb3] uppercase tracking-wider">Inst. (MW)</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-[#8b9cb3] uppercase tracking-wider">Avail. (MW)</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-[#8b9cb3] uppercase tracking-wider">Unavail. (MW)</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-[#8b9cb3] uppercase tracking-wider">Type</th>
                        <th class="px-4 py-3 text-left">
                            <a href="{{ $sortLink('remit_reason') }}" class="remit-sort-link flex items-center gap-1 text-xs font-semibold text-[#8b9cb3] hover:text-[#00d4aa] transition-colors uppercase tracking-wider">
                                REMIT Reason
                                @if($currentSort === 'remit_reason')
                                    <svg class="w-3 h-3 {{ $currentDir === 'asc' ? '' : 'rotate-180' }}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                @endif
                            </a>
                        </th>
                        <th class="px-4 py-3 text-left">
                            <a href="{{ $sortLink('status') }}" class="remit-sort-link flex items-center gap-1 text-xs font-semibold text-[#8b9cb3] hover:text-[#00d4aa] transition-colors uppercase tracking-wider">
                                Status
                                @if($currentSort === 'status')
                                    <svg class="w-3 h-3 {{ $currentDir === 'asc' ? '' : 'rotate-180' }}" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                @endif
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                        <tr class="border-b border-[#2d3a4a] hover:bg-[#24303f]/50 transition-colors">
                            <td class="px-4 py-3">
                                <span class="font-medium text-[#00d4aa]">{{ $event->asset }}</span>
                            </td>
                            <td class="px-4 py-3">
                                <code class="text-xs text-[#8b9cb3] font-mono">{{ $event->event_id }}</code>
                            </td>
                            <td class="px-4 py-3 text-center text-sm text-[#8b9cb3]">{{ $event->revision }}</td>
                            <td class="px-4 py-3 text-sm">{{ $event->published_at->format('Y-m-d H:i') }}</td>
                            <td class="px-4 py-3 text-sm">{{ $event->start_at->format('Y-m-d H:i') }}</td>
                            <td class="px-4 py-3 text-sm">{{ $event->estimated_end_at->format('Y-m-d H:i') }}</td>
                            <td class="px-4 py-3 text-right text-sm tabular-nums">{{ number_format($event->installed_capacity_mw) }}</td>
                            <td class="px-4 py-3 text-right text-sm tabular-nums {{ $event->available_capacity_mw > 0 ? 'text-[#00d4aa]' : 'text-[#8b9cb3]' }}">
                                {{ number_format($event->available_capacity_mw) }}
                            </td>
                            <td class="px-4 py-3 text-right text-sm tabular-nums {{ $event->unavailable_capacity_mw > 0 ? 'text-[#f0b429]' : 'text-[#8b9cb3]' }}">
                                {{ number_format($event->unavailable_capacity_mw) }}
                            </td>
                            <td class="px-4 py-3 text-sm text-[#8b9cb3]">{{ $event->type }}</td>
                            <td class="px-4 py-3">
                                @php
                                    $reasonClass = match(strtolower($event->remit_reason)) {
                                        'forced outage' => 'bg-red-500/20 text-red-400',
                                        'planned outage' => 'bg-amber-500/20 text-amber-400',
                                        'turbine' => 'bg-cyan-500/20 text-cyan-400',
                                        default => 'bg-[#2d3a4a] text-[#8b9cb3]',
                                    };
                                @endphp
                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium {{ $reasonClass }}">
                                    {{ $event->remit_reason }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                @php
                                    $statusClass = match(strtolower($event->status)) {
                                        'active' => 'bg-emerald-500/20 text-emerald-400',
                                        'pending' => 'bg-amber-500/20 text-amber-400',
                                        'suspended' => 'bg-orange-500/20 text-orange-400',
                                        'inactive', 'cancelled', 'withdrawn' => 'bg-zinc-500/20 text-zinc-400',
                                        default => 'bg-[#2d3a4a] text-[#8b9cb3]',
                                    };
                                @endphp
                                <span class="inline-flex px-2 py-0.5 rounded text-xs font-medium {{ $statusClass }}">
                                    {{ $event->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="px-4 py-12 text-center text-[#8b9cb3]">
                                No events match your filters. Try adjusting your search criteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($events->hasPages())
            <div class="px-4 py-3 border-t border-[#2d3a4a] remit-pagination">
                {{ $events->links() }}
            </div>
        @endif
    </div>
</div>

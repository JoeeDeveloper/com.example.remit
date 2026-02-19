@extends('layouts.app')

@section('title', 'Events')

@section('content')
<div class="space-y-6">
    {{-- Info banner --}}
    <div class="rounded-xl bg-[#1a222d] border border-[#2d3a4a] p-4">
        <p class="text-sm text-[#8b9cb3]">
            Filter and search REMIT events by asset, date range, status, or event ID. Data is displayed in GMT.
        </p>
    </div>

    {{-- Filters --}}
    <div class="space-y-4" id="remit-filters">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-7 gap-4">
            {{-- Reset first so Flatpickr calendar (opens below dates) never overlays it --}}
            <div class="flex items-end">
                <button type="button" id="reset-filters" class="w-full sm:w-auto px-4 py-2 rounded-lg border border-[#2d3a4a] text-sm text-[#8b9cb3] hover:bg-[#24303f] hover:text-[#e6edf3] transition-colors cursor-pointer">
                    Reset
                </button>
            </div>
            <div>
                <label for="search" class="block text-xs font-medium text-[#8b9cb3] mb-1">Search</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}"
                    placeholder="Event ID, asset..."
                    class="w-full rounded-lg bg-[#0f1419] border border-[#2d3a4a] px-3 py-2 text-sm text-[#e6edf3] placeholder-[#6b7a8f] focus:border-[#00d4aa] focus:ring-1 focus:ring-[#00d4aa] focus:outline-none transition-colors">
            </div>
            <div>
                <label for="asset" class="block text-xs font-medium text-[#8b9cb3] mb-1">Asset</label>
                <select name="asset" id="asset"
                    class="w-full rounded-lg bg-[#0f1419] border border-[#2d3a4a] px-3 py-2 text-sm text-[#e6edf3] focus:border-[#00d4aa] focus:ring-1 focus:ring-[#00d4aa] focus:outline-none transition-colors">
                    <option value="">All assets</option>
                    @foreach($assets as $a)
                        <option value="{{ $a }}" {{ request('asset') === $a ? 'selected' : '' }}>{{ $a }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="status" class="block text-xs font-medium text-[#8b9cb3] mb-1">Status</label>
                <select name="status" id="status"
                    class="w-full rounded-lg bg-[#0f1419] border border-[#2d3a4a] px-3 py-2 text-sm text-[#e6edf3] focus:border-[#00d4aa] focus:ring-1 focus:ring-[#00d4aa] focus:outline-none transition-colors">
                    <option value="">All statuses</option>
                    @foreach($statuses as $s)
                        <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="start_from" class="block text-xs font-medium text-[#8b9cb3] mb-1">Start from</label>
                <input type="text" name="start_from" id="start_from" value="{{ request('start_from') }}" placeholder="Select date"
                    autocomplete="off"
                    class="w-full rounded-lg bg-[#0f1419] border border-[#2d3a4a] px-3 py-2 text-sm text-[#e6edf3] placeholder-[#6b7a8f] focus:border-[#00d4aa] focus:ring-1 focus:ring-[#00d4aa] focus:outline-none transition-colors cursor-pointer">
            </div>
            <div>
                <label for="end_before" class="block text-xs font-medium text-[#8b9cb3] mb-1">End before</label>
                <input type="text" name="end_before" id="end_before" value="{{ request('end_before') }}" placeholder="Select date"
                    autocomplete="off"
                    class="w-full rounded-lg bg-[#0f1419] border border-[#2d3a4a] px-3 py-2 text-sm text-[#e6edf3] placeholder-[#6b7a8f] focus:border-[#00d4aa] focus:ring-1 focus:ring-[#00d4aa] focus:outline-none transition-colors cursor-pointer">
            </div>
            <div>
                <label for="per_page" class="block text-xs font-medium text-[#8b9cb3] mb-1">Per page</label>
                <select name="per_page" id="per_page"
                    class="w-full rounded-lg bg-[#0f1419] border border-[#2d3a4a] px-3 py-2 text-sm text-[#e6edf3] focus:border-[#00d4aa] focus:ring-1 focus:ring-[#00d4aa] focus:outline-none transition-colors">
                    @foreach([10, 20, 50, 100] as $n)
                        <option value="{{ $n }}" {{ (int) request('per_page', 20) === $n ? 'selected' : '' }}>{{ $n }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- Live-updating table --}}
    <div id="remit-table-container" class="space-y-4" data-url="{{ route('remit.index') }}">
        @include('remit.partials.table')
    </div>
</div>
@endsection

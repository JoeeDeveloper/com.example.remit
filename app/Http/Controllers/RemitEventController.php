<?php

namespace App\Http\Controllers;

use App\Models\RemitEvent;
use Illuminate\Http\Request;

class RemitEventController extends Controller
{
    public function index(Request $request)
    {
        $query = RemitEvent::query()
            ->asset($request->input('asset'))
            ->status($request->input('status'))
            ->startFrom($request->input('start_from'))
            ->endBefore($request->input('end_before'))
            ->search($request->input('search'));

        $sort = $request->input('sort', 'start_at');
        $direction = $request->input('direction', 'asc');

        if (in_array($sort, ['asset', 'event_id', 'published_at', 'start_at', 'estimated_end_at', 'remit_reason', 'status'])) {
            $query->orderBy($sort, in_array($direction, ['asc', 'desc']) ? $direction : 'asc');
        }

        $perPage = (int) $request->input('per_page', 20);
        $perPage = in_array($perPage, [10, 20, 50, 100]) ? $perPage : 20;

        $events = $query->paginate($perPage)->withQueryString();

        $assets = RemitEvent::distinct()->pluck('asset')->sort()->values();
        $statuses = ['Active', 'Pending', 'Suspended', 'Inactive', 'Cancelled', 'Withdrawn'];

        if ($request->ajax() || $request->wantsJson()) {
            return view('remit.partials.table', compact('events'));
        }

        return view('remit.index', compact('events', 'assets', 'statuses'));
    }
}

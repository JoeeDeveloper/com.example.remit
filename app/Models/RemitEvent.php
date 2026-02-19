<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RemitEvent extends Model
{
    protected $fillable = [
        'asset',
        'event_id',
        'revision',
        'published_at',
        'start_at',
        'estimated_end_at',
        'installed_capacity_mw',
        'available_capacity_mw',
        'unavailable_capacity_mw',
        'type',
        'remit_reason',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'start_at' => 'datetime',
            'estimated_end_at' => 'datetime',
            'installed_capacity_mw' => 'integer',
            'available_capacity_mw' => 'integer',
            'unavailable_capacity_mw' => 'integer',
        ];
    }

    public function scopeAsset($query, ?string $asset)
    {
        return $asset ? $query->where('asset', $asset) : $query;
    }

    public function scopeStatus($query, ?string $status)
    {
        return $status ? $query->where('status', $status) : $query;
    }

    public function scopeStartFrom($query, ?string $date)
    {
        return $date ? $query->whereDate('start_at', '>=', $date) : $query;
    }

    public function scopeEndBefore($query, ?string $date)
    {
        return $date ? $query->whereDate('estimated_end_at', '<=', $date) : $query;
    }

    public function scopeSearch($query, ?string $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {
            $q->where('asset', 'like', "%{$search}%")
                ->orWhere('event_id', 'like', "%{$search}%")
                ->orWhere('remit_reason', 'like', "%{$search}%");
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Requisition extends Model
{
    protected $fillable = [
        'requisition_no',
        'user_id',
        'title',
        'description',
        'status',
        'reviewed_by',
        'reviewed_at',
        'approved_by',
        'approved_at',
        'acknowledged_at',
        'admin_remarks'
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
        'approved_at' => 'datetime',
        'acknowledged_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(RequisitionItem::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Helper to get status text
    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            0 => 'Pending',
            1 => 'Reviewed',
            2 => 'Approved',
            3 => 'Cancelled',
            4 => 'Acknowledged',
            default => 'Unknown',
        };
    }
}

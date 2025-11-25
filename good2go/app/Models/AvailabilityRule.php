<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AvailabilityRule extends Model
{
    protected $fillable = [
        'driver_id',
        'rule_type',
        'day_of_week',
        'specific_date',
        'start_time',
        'end_time',
        'is_available',
        'meta',
    ];

    protected $casts = [
        'specific_date' => 'date',
        'is_available' => 'boolean',
        'meta' => 'array',
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }
}

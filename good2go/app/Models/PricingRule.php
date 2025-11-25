<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PricingRule extends Model
{
    protected $fillable = [
        'service_type_id',
        'hire_type',
        'currency',
        'base_rate',
        'min_hours',
        'daily_hours',
        'night_surcharge_type',
        'night_surcharge_value',
        'is_active',
    ];

    protected $casts = [
        'base_rate' => 'decimal:2',
        'night_surcharge_value' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function serviceType(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'service_type_id',
        'driver_id',
        'hire_type',
        'start_datetime',
        'end_datetime',
        'duration_hours',
        'pickup_location',
        'dropoff_location',
        'notes',
        'payment_method',
        'payment_status',
        'booking_status',
        'total_price',
        'currency',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    protected function casts(): array
    {
        return [
            'start_datetime' => 'datetime',
            'end_datetime' => 'datetime',
        ];
    }
}

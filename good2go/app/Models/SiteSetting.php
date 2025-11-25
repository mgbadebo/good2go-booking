<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
        'is_json',
    ];

    protected $casts = [
        'is_json' => 'boolean',
    ];
}

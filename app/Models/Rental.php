<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bike_id',
        'rental_start',
        'rental_end',
        'total_price',
        'status',
        'notes'
    ];

    protected $casts = [
        'rental_start' => 'datetime',
        'rental_end' => 'datetime',
        'total_price' => 'decimal:2'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bike(): BelongsTo
    {
        return $this->belongsTo(Bike::class);
    }

    public function calculateTotalPrice(): float
    {
        if (!$this->rental_end) {
            return 0;
        }

        $hours = $this->rental_start->diffInHours($this->rental_end);
        $bike = $this->bike;
        
        return $hours * floatval($bike->price);
    }
}
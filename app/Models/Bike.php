<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    /** @use HasFactory<\Database\Factories\BikeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'model',
        'color',
        'type',
        'size',
        'price',
        'description',
        'image_url',
        'status'
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function isAvailable(): bool
    {
        return !$this->rentals()
            ->where('status', 'active')
            ->exists();
    }
}

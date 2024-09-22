<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;

    protected $fillable = [
        'license_plate',
        'production_year',
        'brand',
        'mileage',
        'color',
        'length',
        'height',
        'vin',
        'driver_id',
        'is_active'
    ];

    // Relacja: jeden kierowca może mieć jeden samochód
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
    public function drivers()
    {
        return $this->belongsToMany(User::class, 'driver_truck')
            ->withPivot('started_driving_at', 'ended_driving_at', 'starting_mileage', 'ending_mileage', 'fuel_consumed')
            ->withTimestamps();
    }

}

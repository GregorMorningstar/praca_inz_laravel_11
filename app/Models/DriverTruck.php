<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverTruck extends Model
{
    use HasFactory;

    // Nazwa tabeli
    protected $table = 'driver_truck';


    protected $fillable = [
        'user_id',
        'truck_id',
        'order_id',
        'started_driving_at',
        'ended_driving_at',
        'starting_mileage',
        'ending_mileage',
        'fuel_consumed',
    ];

    // Relacja z tabelą users (kierowca)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relacja z tabelą trucks (ciężarówka)
    public function truck()
    {
        return $this->belongsTo(Truck::class);
    }

    // Relacja z tabelą orders (zamówienie)
    public function order()
    {
        return $this->belongsTo(Order::class);
    }



    // Obliczanie przejechanego dystansu
    public function distanceDriven()
    {
        if ($this->hasEndedDriving() && $this->ending_mileage) {
            return $this->ending_mileage - $this->starting_mileage;
        }
        return null;
    }

    // Obliczanie zużycia paliwa na kilometr
    public function fuelConsumptionPerKm()
    {
        $distance = $this->distanceDriven();
        if ($distance && $this->fuel_consumed) {
            return $this->fuel_consumed / $distance;
        }
        return null;
    }
}

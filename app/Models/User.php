<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function truck()
    {
        return $this->hasOne(Truck::class, 'driver_id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'photo',
        'phone',
        'address',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    //relacja z tabela lacznikowa
    public function driverTrucks()
    {
        return $this->hasMany(DriverTruck::class);
    }
    public function trucks()
    {
        return $this->belongsToMany(Truck::class, 'driver_truck')
            ->withPivot('started_driving_at', 'ended_driving_at', 'starting_mileage', 'ending_mileage', 'fuel_consumed')
            ->withTimestamps();
    }
}

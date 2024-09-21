<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $dates = ['loading_date', 'delivery_date'];

    protected $fillable = [
        'place_of_loading',
        'loading_date',
        'place_of_delivery',
        'delivery_date',
        'cargo_weight',
        'cargo_length',
        'mileage',
        'cost',
        'user_id',
    ];
    protected $casts = [
        'loading_date' => 'datetime',
        'delivery_date' => 'datetime',
    ];
    // Definiowanie relacji z modelem User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

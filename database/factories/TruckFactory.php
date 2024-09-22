<?php

namespace Database\Factories;

use App\Models\Truck;
use Illuminate\Database\Eloquent\Factories\Factory;

class TruckFactory extends Factory
{
    protected $model = Truck::class;

    public function definition()
    {
        $brands = ['Volvo', 'Man', 'Scania', 'Renault', 'Ford', 'Daf'];

        return [
            'license_plate' => $this->faker->unique()->bothify('??? #####'),
            'production_year' => $this->faker->year(),
            'brand' => $this->faker->randomElement($brands), // Losowa marka z dostępnych
            'mileage' => $this->faker->numberBetween(10000, 100000),
            'color' => $this->faker->safeColorName,
            'length' => $this->faker->numberBetween(4, 8),
            'height' => $this->faker->numberBetween(2, 4),
            'vin' => $this->faker->unique()->regexify('[A-HJ-NPR-Z0-9]{17}'),
            'driver_id' => null, // Na początku brak przypisanego kierowcy
            'status' => 'inactive', // Ustaw status na 'inactive'
        ];
    }
}

<?php
namespace Database\Factories;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
class OrderFactory extends Factory
{
    protected $model = Order::class;
    public function definition()
    {
        // Tablica z losowymi miastami w Polsce
        $polishCities = [
            'Warszawa','Kraków','Łódź','Wrocław','Poznań','Gdańsk','Szczecin','Bydgoszcz','Lublin','Katowice','Gdynia','Czestochowa','Radom','Sosnowiec','Toruń','Zabrze','Bielsko-Biała','Rzeszów',
            'Opole','Elbląg',
        ];
        $loadingDate = $this->faker->dateTimeBetween('-1 year', 'now'); // Data załadunku z ostatniego roku
        $deliveryDate = $this->faker->dateTimeBetween($loadingDate, $loadingDate->modify('+5 days')); // Data dostawy od 1 do 5 dni po dacie załadunku
        // Pobierz losowego użytkownika z rolą 'user'
        $user = User::where('role', 'user')->inRandomOrder()->first();
        return [
            'place_of_loading' => $this->faker->randomElement($polishCities), // Losowe miasto z tablicy jako miejsce załadunku
            'loading_date' => $loadingDate,
            'place_of_delivery' => $this->faker->randomElement($polishCities), // Losowe miasto z tablicy jako miejsce dostawy
            'delivery_date' => $deliveryDate,
            'cargo_weight' => $this->faker->randomFloat(2, 1, 1000), // Waga towaru
            'cargo_length' => $this->faker->randomFloat(2, 0.1, 10), // Długość towaru
            'mileage' => $this->faker->numberBetween(1, 500), // Ilość kilometrów
            'cost' => $this->faker->randomFloat(2, 10, 1000), // Koszt
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'canceled', 'completed']),
            'user_id' => $user ? $user->id : null, // Przypisanie losowego użytkownika z rolą 'user'
        ];
    }
}

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('place_of_loading'); // Miejsce załadunku
            $table->date('loading_date'); // Data załadunku
            $table->string('place_of_delivery'); // Miejsce dostawy
            $table->date('delivery_date'); // Data dostawy
            $table->decimal('cargo_weight', 8, 2); // Waga towaru
            $table->decimal('cargo_length', 8, 2); // Długość towaru
            $table->integer('mileage'); // Ilość kilometrów
            $table->decimal('cost', 10, 2); // Koszt
            $table->enum('status', ['pending', 'in_progress', 'canceled', 'completed'])->default('pending'); // Status zlecenia
            $table->unsignedBigInteger('user_id'); // Klucz obcy do tabeli users
            $table->timestamps();

            // Definiowanie klucza obcego
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}

<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverTruckTable extends Migration
{
    public function up()
    {
        Schema::create('driver_truck', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Klucz obcy do tabeli users
            $table->foreignId('truck_id')->constrained()->onDelete('cascade'); // Klucz obcy do tabeli trucks
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Klucz obcy do tabeli orders
            $table->date('started_driving_at')->nullable(); // Data rozpoczęcia jazdy
            $table->date('ended_driving_at')->nullable(); // Data zakończenia jazdy
            $table->integer('starting_mileage')->nullable(); // Przebieg na start
            $table->integer('ending_mileage')->nullable(); // Przebieg na koniec
            $table->float('fuel_consumed')->nullable(); // Ilość zużytego paliwa
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('driver_truck');
    }
}

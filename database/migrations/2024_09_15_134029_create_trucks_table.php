<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate')->unique();   // Numer rejestracyjny
            $table->year('production_year');              // Rok produkcji
            $table->string('brand');                     // Marka
            $table->integer('mileage');                  // Przebieg
            $table->string('color');                     // Kolor
            $table->decimal('length', 8, 2);             // Długość
            $table->decimal('height', 8, 2);             // Wysokość
            $table->string('vin')->unique();             // Numer VIN
            $table->unsignedBigInteger('driver_id')->nullable(); // Klucz obcy do usera
            $table->timestamps();

            // Relacja z tabelą users (rola kierowca)
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('trucks');
    }

};

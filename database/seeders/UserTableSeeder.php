<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('users')->insert([
           //admin
            [
              'name' => 'Admin',
              'username' => 'admin',
              'email' => 'admin@gmail.com',
              'password' => Hash::make('qwer1234'),
              'role' => 'admin',
                'phone' =>fake()->phoneNumber,
                'address' => fake()->address,
                'photo' => fake()->imageUrl('50','50'),
                ],
           //dispatcher
            [
                'name' => 'Spedytor',
                'username' => 'spedytor',
                'email' => 'spedytor@gmail.com',
                'password' => Hash::make('qwer1234'),
                'role' => 'dispatcher',
                'phone' =>fake()->phoneNumber,
                'address' => fake()->address,
                'photo' => fake()->imageUrl('50','50'),
            ],
            //driver
            [
                'name' => 'Driver',
                'username' => 'driver',
                'email' => 'driver@gmail.com',
                'password' => Hash::make('qwer1234'),
                'role' => 'driver',
                 'phone' =>fake()->phoneNumber,
            'address' => fake()->address,
            'photo' => fake()->imageUrl('50','50'),
            ],
           //user
            [
                'name' => 'User',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('qwer1234'),
                'role' => 'user',
                'phone' =>fake()->phoneNumber,
                'address' => fake()->address,
                'photo' => fake()->imageUrl('50','50'),
            ],
        ]);
        //
    }
}

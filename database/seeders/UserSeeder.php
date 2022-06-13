<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        \App\Models\User::factory()->create( [
            'name'     => $faker->userName,
            'email'    => 'admin@laravel-store.test',
            'password' => Hash::make( 'secret' ),
            'role' => 'admin',
        ] );

        for ( $i = 0; $i < 5; $i++ ) {
            \App\Models\User::factory()->create( [
                'name'     => $faker->userName,
                'email'    => $faker->email,
                'password' => Hash::make( 'secret' ),
                'role' => 'customer',
            ] );
        }
    }
}

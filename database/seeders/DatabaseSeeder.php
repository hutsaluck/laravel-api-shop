<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
//         \App\Models\User::factory(50)->create();
        $this->call(UserSeeder::class);
         \App\Models\Product::factory(50)->create();
         \App\Models\Review::factory(50)->create();
         \App\Models\Order::factory(50)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

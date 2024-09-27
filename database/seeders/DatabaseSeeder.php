<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a customer user (type = 0)
        User::factory()->create([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('12345678'), 
            'type' => 0, // 0 = Customer
        ]);

        // Create an admin user (type = 1)
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'type' => 1, // 1 = Admin
        ]);
    }
}

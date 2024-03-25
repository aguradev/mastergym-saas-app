<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use App\Models\Gym\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Stancl\Tenancy\Database\Models\Domain;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Tenant::truncate();
        Domain::truncate();
        Tenant::factory(5)->create();

        // CentralCredential::factory(1)->create([
        //     "username" => "admin",
        //     "email" => "admin@localhost.com",
        //     "password" => Hash::make("adminganteng23")
        // ]);
    }
}

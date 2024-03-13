<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Auth\CentralCredential;
use App\Models\Auth\Credential;
use App\Models\Auth\TenantCredential;
use App\Models\Gym\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $tenant = Tenant::where("vendor", "bagas")->first();

        // $tenant->run(function () {
        //     TenantCredential::factory(3)->create();
        // });

        CentralCredential::factory(1)->create([
            "username" => "admin",
            "email" => "admin@localhost.com",
            "password" => Hash::make("admin123")
        ]);
    }
}

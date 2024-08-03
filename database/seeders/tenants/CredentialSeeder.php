<?php

namespace Database\Seeders\tenants;

use App\Models\Auth\TenantCredential;
use App\Models\TenancyModel\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CredentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TenantCredential::truncate();
        User::truncate();


        try {
            DB::beginTransaction();

            TenantCredential::factory(1)->has(User::factory(), "User")->create([
                "username" => "super admin",
                "email" => "superadmin@gym.com",
                "password" => Hash::make("superadmin123")
            ]);

            DB::commit();
        } catch (\Throwable $err) {
            DB::rollBack();
        }
    }
}

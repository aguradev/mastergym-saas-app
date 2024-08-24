<?php

namespace Database\Seeders\tenants;

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
        User::truncate();

        try {
            DB::beginTransaction();

            User::create([
                "first_name" => "super",
                "last_name" => "admin",
                "username" => "super admin",
                "email" => "superadmin@gym.com",
                "password" => Hash::make("superadmin123"),
            ]);

            DB::commit();
        } catch (\Throwable $err) {
            DB::rollBack();
        }
    }
}

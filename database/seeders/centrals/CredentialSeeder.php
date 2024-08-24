<?php

namespace Database\Seeders\Centrals;

use App\Models\Auth\CentralCredential;
use App\Models\CentralModel\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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

            User::create(
                [
                    "username" => "admin",
                    "first_name" => "admin",
                    "last_name" => "super",
                    "email" => "admin@localhost.com",
                    "bio" => fake()->paragraph(),
                    "password" => Hash::make("adminganteng23")
                ]
            );

            DB::commit();

            echo "Create user successfully";
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            DB::rollBack();
            echo "Transaction failed";
        }
    }
}

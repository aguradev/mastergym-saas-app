<?php

namespace Database\Seeders;

use App\Models\Auth\CentralCredential;
use App\Models\CentralModel\User;
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
        CentralCredential::truncate();
        User::truncate();

        try {
            DB::beginTransaction();

            CentralCredential::factory(1)->has(User::factory(), "User")->create([
                "username" => "admin",
                "email" => "admin@localhost.com",
                "password" => Hash::make("adminganteng23")
            ]);

            DB::commit();

            echo "Create user successfully";
        } catch (\Throwable $th) {
            DB::rollBack();
            echo "Transaction failed";
        }
    }
}

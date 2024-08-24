<?php

namespace Database\Seeders\Centrals;

use App\Models\Auth\CentralCredential;
use App\Models\CentralModel\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $getUser = User::whereEmail("admin@localhost.com")->first();

        if ($getUser) {
            $getUser->assignRole("Super admin");
        }
    }
}

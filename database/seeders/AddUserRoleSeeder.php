<?php

namespace Database\Seeders;

use App\Models\Auth\CentralCredential;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $getUser = CentralCredential::whereEmail("admin@localhost.com")->first();

        if ($getUser) {
            $getUser->User->assignRole("Super admin");
        }
    }
}

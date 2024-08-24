<?php

namespace Database\Seeders\tenants;

use App\Models\TenancyModel\User;
use Illuminate\Database\Seeder;

class AddSuperAdminRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $getUser = User::whereEmail("superadmin@gym.com")->first();

        if ($getUser) {
            $getUser->assignRole("Super admin");
        }
    }
}

<?php

namespace Database\Seeders\tenants;

use App\Models\Auth\TenantCredential;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddSuperAdminRole extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $getUser = TenantCredential::whereEmail("superadmin@gym.com")->first();

        if ($getUser) {
            $getUser->User->assignRole("Super admin");
        }
    }
}

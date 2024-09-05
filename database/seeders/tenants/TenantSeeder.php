<?php

namespace Database\Seeders\tenants;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            AddPermissionSeeder::class,
            RoleSeeder::class,
            CredentialSeeder::class,
            AddSuperAdminRole::class,
            TenantWebsiteSeeder::class,
            MemberPlanFeatureSeeder::class,
        ]);
    }
}

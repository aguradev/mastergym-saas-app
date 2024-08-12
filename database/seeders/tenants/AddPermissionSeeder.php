<?php

namespace Database\Seeders\tenants;

use App\Models\Authorization\Permission;
use App\Models\Gym\Tenant;
use Error;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenantId = tenant('id');
        $findTenants = Tenant::whereId($tenantId)->first();
        $permissionLists = [
            "access_dashboard_menu_tenant",
            "access_dashboard_menu_member"
        ];

        if (!$findTenants) {
            throw new Error("tenant not found");
        }

        $findTenants->run(function () use ($permissionLists) {
            foreach ($permissionLists as $permission) {
                Permission::create([
                    "name" => $permission,
                    "guard_name" => "tenant-web"
                ]);
            }
        });
    }
}

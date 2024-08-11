<?php

namespace Database\Seeders\Tenants;

use App\Enums\CentralRolesEnum;
use App\Models\Authorization\Role;
use App\Models\Gym\Tenant;
use Error;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use TenantRolesEnum;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rolesLists = [
            TenantRolesEnum::SUPERADMIN->value,
            TenantRolesEnum::ADMIN->value,
            TenantRolesEnum::MEMBER->value
        ];

        $tenantId = tenant('id');
        $findTenants = Tenant::whereId($tenantId)->first();

        if (!$findTenants) {
            throw new Error("tenant not found");
        }

        $findTenants->run(function () use ($rolesLists) {
            foreach ($rolesLists as $role) {
                Role::create([
                    "name" => $role,
                    "guard_name" => "tenant-web"
                ]);
            }
        });
    }
}

<?php

namespace Database\Seeders\Tenants;

use App\Enums\TenantRolesEnum;
use App\Models\Authorization\Role;
use App\Models\Gym\Tenant;
use Error;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        foreach ($rolesLists as $role) {
            $createRole = Role::create([
                "name" => $role,
                "guard_name" => "tenant-web"
            ]);

            if ($role == "Super admin" || $role == "Admin") {
                $createRole->givePermissionTo("access_dashboard_menu_tenant");
            } else {
                $createRole->givePermissionTo("access_dashboard_menu_member");
            }
        }
    }
}

<?php

namespace Database\Seeders\Tenants;

use App\Enums\CentralRolesEnum;
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
        $findTenants = Tenant::whereId("9c5b145a-2898-4f91-aeda-a9531b41d5d7")->first();

        if (!$findTenants) {
            throw new Error("tenant not found");
        }

        $findTenants->run(function () {
            Role::create([
                "name" => CentralRolesEnum::SUPERADMIN->value
            ]);
        });
    }
}

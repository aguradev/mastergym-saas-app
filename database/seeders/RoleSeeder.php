<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Authorization\Role as AuthorizationRole;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AuthorizationRole::truncate();

        $createRole = AuthorizationRole::create(
            ["name" => "Super admin"]
        );

        if ($createRole) {
            echo "Role created";
            return;
        }

        echo "Role failed";
    }
}

<?php

namespace Database\Seeders\Centrals;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gym\Tenant;
use Stancl\Tenancy\Database\Models\Domain;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tenant::truncate();
        Domain::truncate();
        Tenant::factory(5)->create();
    }
}

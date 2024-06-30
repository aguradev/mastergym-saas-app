<?php

namespace Database\Seeders\Centrals;

use App\Models\CentralModel\TenantPlanFeature as CentralModelTenantPlanFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantPlanFeature extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $planFeatures = collect([
            "Booking personal trainer",
            "Manage personal trainer",
            "Manage staff",
            "30 staff account",
            "100 staff account",
            "Unlimited staff account",
            "50 membership user",
            "100 membership user",
            "500 membership user",
            "Unlimited membership user",
        ]);

        CentralModelTenantPlanFeature::truncate();

        $planFeatures->map(fn ($feature) => CentralModelTenantPlanFeature::create([
            "name" => $feature,
            "created_at" => now()
        ]));
    }
}

<?php

namespace Database\Seeders\tenants;

use App\Models\TenancyModel\MembershipFeature as TenantModelMembershipPlanFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberPlanFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $planFeatures = collect([
            "Access to All Equipment",
            "Shower Room",
            "Weekly Classes",
            "Sauna Room",
            "24/7 access",
            "Occational events"
        ]);

        TenantModelMembershipPlanFeature::truncate();

        $planFeatures->map(fn($feature) => TenantModelMembershipPlanFeature::create([
            "title" => $feature,
            "status" => "active",
            "created_at" => now()
        ]));
    }
}

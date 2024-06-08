<?php

namespace App\CentralServices\SubscriptionPlan\Repositories\Interfaces;

use App\Models\CentralModel\TenantPlanVersion;
use App\Models\CentralModel\TenantSubscriptionPlan;

interface SubscriptionPlanInterface
{
    public function GetAllSubscriptionPlans();
    public function CreateSubscriptionPlan(array $request);
    public function CreateSubscriptionPlanVersion(array $request, TenantSubscriptionPlan $tenantSubscriptionPlan);
    public function AddSubscriptionFeatureInPlan($request, TenantPlanVersion $tenantPlanVersion);
}

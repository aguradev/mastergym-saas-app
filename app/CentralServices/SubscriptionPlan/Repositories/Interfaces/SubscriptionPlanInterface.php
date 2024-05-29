<?php

namespace App\CentralServices\SubscriptionPlan\Repositories\Interfaces;

use App\Models\CentralModel\TenantSubscriptionPlan;

interface SubscriptionPlanInterface
{
    public function GetAllSubscriptionPlans();
    public function CreateSubscriptionPlan(array $request);
    public function AddSubscriptionFeatureInPlan($request, TenantSubscriptionPlan $tenantSubscriptionPlan);
}

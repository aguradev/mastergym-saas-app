<?php

namespace App\CentralServices\SubscriptionPlan\Repositories\Implement;

use Illuminate\Support\Str;
use App\Models\CentralModel\TenantSubscriptionPlan;
use App\CentralServices\SubscriptionPlan\Repositories\Interfaces\SubscriptionPlanInterface;

class SubscriptionPlanRepoImpl implements SubscriptionPlanInterface
{
    private $TenantSubscriptionModel;

    public function __construct(TenantSubscriptionPlan $subcriptionPlan)
    {
        $this->TenantSubscriptionModel = $subcriptionPlan;
    }

    public function GetAllSubscriptionPlans()
    {
        return $this->TenantSubscriptionModel::with('PlanFeatures')->get();
    }

    public function CreateSubscriptionPlan(array $request)
    {
        return TenantSubscriptionPlan::create($request);
    }

    public function AddSubscriptionFeatureInPlan($request, TenantSubscriptionPlan $tenantSubscriptionPlan)
    {
        return $tenantSubscriptionPlan->PlanFeatures()->syncWithPivotValues($request, ["id" => Str::uuid()], false);
    }
}

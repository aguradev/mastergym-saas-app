<?php

namespace App\CentralServices\SubscriptionPlan\Repositories\Implement;

use Illuminate\Support\Str;
use App\Models\CentralModel\TenantSubscriptionPlan;
use App\CentralServices\SubscriptionPlan\Repositories\Interfaces\SubscriptionPlanInterface;
use App\Models\CentralModel\TenantPlanVersion;

class SubscriptionPlanRepoImpl implements SubscriptionPlanInterface
{
    private $TenantSubscriptionModel;

    public function __construct(TenantSubscriptionPlan $subcriptionPlan)
    {
        $this->TenantSubscriptionModel = $subcriptionPlan;
    }

    public function GetAllSubscriptionPlans()
    {
        return $this->TenantSubscriptionModel::with(["TenantVersionLatest" => function ($query) {
            $query->withCount("PlanFeatures");
        }])->get();
    }

    public function CreateSubscriptionPlan(array $request)
    {
        return TenantSubscriptionPlan::create($request);
    }

    public function CreateSubscriptionPlanVersion(array $request, TenantSubscriptionPlan $tenantSubscriptionPlan)
    {
        return $tenantSubscriptionPlan->TenantLogVersions()->create($request);
    }

    public function AddSubscriptionFeatureInPlan($request, TenantPlanVersion $tenantPlanVersion)
    {
        return $tenantPlanVersion->PlanFeatures()->syncWithPivotValues($request, ["id" => Str::uuid()], false);
    }
}

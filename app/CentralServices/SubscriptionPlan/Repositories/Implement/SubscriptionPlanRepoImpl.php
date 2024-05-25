<?php

namespace App\CentralServices\SubscriptionPlan\Repositories\Implement;

use App\CentralServices\SubscriptionPlan\Repositories\Interfaces\SubscriptionPlanInterface;
use App\Models\CentralModel\TenantSubscriptionPlan;

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

    public function CreateSubscriptionPlan($request)
    {
        return $this->TenantSubscriptionModel::create($request);
    }
}

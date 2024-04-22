<?php

namespace App\CentralServices\SubscriptionPlan\Repositories\Implement;

use App\CentralServices\SubscriptionPlan\Repositories\Interfaces\FeaturePlanInterface;
use App\Models\CentralModel\TenantPlanFeature;

class FeaturePlanRepoImpl implements FeaturePlanInterface
{
    private $FeaturePlanModel;

    public function __construct(TenantPlanFeature $planFeature)
    {
        $this->FeaturePlanModel = $planFeature;
    }

    public function CreatePlanFeature($request)
    {
        return $this->FeaturePlanModel::create($request);
    }
}
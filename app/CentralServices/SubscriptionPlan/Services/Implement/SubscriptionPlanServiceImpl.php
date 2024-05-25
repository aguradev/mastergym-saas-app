<?php

namespace App\CentralServices\SubscriptionPlan\Services\Implement;

use App\CentralServices\SubscriptionPlan\Repositories\Interfaces\SubscriptionPlanInterface as SubscriptionPlanInterfaceRepo;
use App\CentralServices\SubscriptionPlan\Services\Interfaces\SubscriptionPlanInterface;

class SubscriptionPlanServiceImpl implements SubscriptionPlanInterface
{
    private $SubscriptionPlanRepo;

    public function __construct(SubscriptionPlanInterfaceRepo $subscriptionPlan)
    {
        $this->SubscriptionPlanRepo = $subscriptionPlan;
    }
    public function GetAllSubscriptionPlans()
    {
        return $this->SubscriptionPlanRepo->GetAllSubscriptionPlans();
    }
}

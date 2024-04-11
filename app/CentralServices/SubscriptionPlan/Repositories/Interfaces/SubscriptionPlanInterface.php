<?php

namespace App\CentralServices\SubscriptionPlan\Repositories\Interfaces;

interface SubscriptionPlanInterface
{
    public function GetAllSubscriptionPlans();
    public function CreateSubscriptionPlan($request);
}

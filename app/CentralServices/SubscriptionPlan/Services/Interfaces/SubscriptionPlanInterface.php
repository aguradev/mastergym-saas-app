<?php

namespace App\CentralServices\SubscriptionPlan\Services\Interfaces;

interface SubscriptionPlanInterface
{
    public function GetAllSubscriptionPlans();
    public function CreateSubscriptionPlanHandler(array $request);
}

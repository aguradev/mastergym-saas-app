<?php

namespace App\CentralServices\SubscriptionPlan\Repositories\Interfaces;


interface FeaturePlanInterface
{
    public function CreatePlanFeature($request);
    public function DeletePlanFeature($id);
}

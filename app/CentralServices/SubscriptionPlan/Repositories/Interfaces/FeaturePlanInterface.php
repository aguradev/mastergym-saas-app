<?php

namespace App\CentralServices\SubscriptionPlan\Repositories\Interfaces;


interface FeaturePlanInterface
{
    public function CreatePlanFeature($request);
    public function DeletePlanFeature($id);
    public function UpdatePlanFeature($request, $id);
}

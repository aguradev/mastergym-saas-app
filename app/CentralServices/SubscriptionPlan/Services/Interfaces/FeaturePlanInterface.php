<?php

namespace App\CentralServices\SubscriptionPlan\Services\Interfaces;

interface FeaturePlanInterface
{
    public function CreateFeaturePlanHandler(array $requestItems);
    public function DeleteFeaturePlanHandler(string $id);
    public function UpdateFeaturePlanHandler(array $request);
}

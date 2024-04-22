<?php

namespace App\CentralServices\SubscriptionPlan\Services\Implement;

use App\CentralServices\SubscriptionPlan\Services\Interfaces\FeaturePlanInterface;
use App\Http\Requests\CentralRequest\CreateFeaturePlanRequest;
use Illuminate\Http\Request;

class FeaturePlanServiceImpl implements FeaturePlanInterface
{
    public function CreateFeaturePlanHandler($request)
    {
        $featureItems = $request->all()["items"];
    }
}

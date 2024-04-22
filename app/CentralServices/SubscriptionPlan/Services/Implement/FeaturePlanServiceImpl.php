<?php

namespace App\CentralServices\SubscriptionPlan\Services\Implement;

use App\CentralServices\SubscriptionPlan\Services\Interfaces\FeaturePlanInterface;
use Illuminate\Http\Request;

class FeaturePlanServiceImpl implements FeaturePlanInterface
{
    public function CreateFeaturePlanHandler(Request $request)
    {
        dd($request->all());
    }
}

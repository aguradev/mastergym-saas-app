<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\Subscriptions;

use App\CentralServices\SubscriptionPlan\Services\Interfaces\FeaturePlanInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CentralRequest\CreateFeaturePlanRequest;

class FeaturePlanController extends Controller
{
    protected $FeaturePlanServices;

    public function __construct(FeaturePlanInterface $featurePlan)
    {
        $this->FeaturePlanServices = $featurePlan;
    }
    public function CreateFeaturePlan(CreateFeaturePlanRequest $request)
    {
        $this->FeaturePlanServices->CreateFeaturePlanHandler($request->items);
        return to_route('central-dashboard.subscriptions');
    }
}

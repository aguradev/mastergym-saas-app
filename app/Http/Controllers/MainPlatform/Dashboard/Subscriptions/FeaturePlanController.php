<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\Subscriptions;

use App\CentralServices\SubscriptionPlan\Services\Interfaces\FeaturePlanInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeaturePlanController extends Controller
{
    protected $FeaturePlanServices;

    public function __construct(FeaturePlanInterface $featurePlan)
    {
        $this->FeaturePlanServices = $featurePlan;
    }
    public function CreateFeaturePlan(Request $request)
    {
        // $this->FeaturePlanServices->CreateFeaturePlanHandler($request);

        return to_route('central-dashboard.subscriptions');
    }
}

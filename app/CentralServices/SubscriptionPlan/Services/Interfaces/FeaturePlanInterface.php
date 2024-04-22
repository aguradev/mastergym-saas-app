<?php

namespace App\CentralServices\SubscriptionPlan\Services\Interfaces;

use Illuminate\Http\Request;

interface FeaturePlanInterface
{
    public function CreateFeaturePlanHandler(Request $request);
}

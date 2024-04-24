<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\Subscriptions;

use App\CentralServices\SubscriptionPlan\Services\Interfaces\FeaturePlanInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CentralRequest\CreateFeaturePlanRequest;
use App\Models\CentralModel\TenantPlanFeature;
use Inertia\Inertia;

class FeaturePlanController extends Controller
{
    protected $FeaturePlanServices;

    public function __construct(FeaturePlanInterface $featurePlan)
    {
        $this->FeaturePlanServices = $featurePlan;
    }
    public function FeaturePlanTable()
    {
        $planFeaturesQuery = TenantPlanFeature::orderBy("created_at", "desc")->paginate(8);

        return Inertia::render('views/dashboard/central_page/subscription_page/PlanFeaturesPage', compact('planFeaturesQuery'));
    }

    public function CreateFeaturePlan(CreateFeaturePlanRequest $request)
    {
        $this->FeaturePlanServices->CreateFeaturePlanHandler($request->items);

        return redirect()->back();
    }

    public function EditForm(TenantPlanFeature $tenantPlanFeature)
    {
        dd($tenantPlanFeature);
    }
}

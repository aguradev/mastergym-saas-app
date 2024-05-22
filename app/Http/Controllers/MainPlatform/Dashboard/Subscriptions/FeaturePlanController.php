<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\Subscriptions;

use App\CentralServices\SubscriptionPlan\Services\Interfaces\FeaturePlanInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CentralRequest\CreateFeaturePlanRequest;
use App\Http\Requests\CentralRequest\EditFeaturePlanRequest;
use App\Models\CentralModel\TenantPlanFeature;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
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
        $planFeaturesQuery = TenantPlanFeature::orderBy("created_at", "desc")->orderBy("name", "asc")->paginate(8);

        return Inertia::render('dashboard/central_page/subscription_page/features_plan_page/Index', compact('planFeaturesQuery'));
    }

    public function AllFeaturePlan()
    {
        $data = TenantPlanFeature::toBase()->get();

        return response()->json([
            "status" => "Get All Feature Plan",
            "results" => $data,
        ])->withHeaders([
            "Content-Type" => "application/json",
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function featurePlanDetail(TenantPlanFeature $tenantPlanFeature)
    {
        return response()->json([
            "status" => "Get Data Feature Plan Detail",
            "results" => $tenantPlanFeature
        ])->withHeaders([
            "Content-Type" => "application/json",
        ])->setStatusCode(Response::HTTP_OK);
    }

    public function CreateFeaturePlan(CreateFeaturePlanRequest $request)
    {
        try {
            $this->FeaturePlanServices->CreateFeaturePlanHandler($request->items);
            return redirect()->back()->with('message_success', 'Success create features plan');
        } catch (\Throwable $err) {
            Log::error($err);
            return redirect()->back()->with("message_error", "Failed create features plan");
        }
    }

    public function DeleteFeature(TenantPlanFeature $tenantPlanFeature)
    {
        try {
            $isDeleted = $this->FeaturePlanServices->DeleteFeaturePlanHandler($tenantPlanFeature->id);

            return redirect()->back()->with('message_success', 'Feature Deleted');
        } catch (\Throwable $th) {
            Debugbar::debug($th);
            return redirect()->back()->with("message_error", "Failed delete feature");
        }
    }

    public function UpdateFeature(TenantPlanFeature $tenantPlanFeature, EditFeaturePlanRequest $request)
    {
        $updateFeatureHandler = $this->FeaturePlanServices->UpdateFeaturePlanHandler($request->all());

        if (!$updateFeatureHandler) {
            return redirect()->back()->with('message_error', 'Feature plan failed update');
        }

        return redirect()->back()->with('message_success', 'Feature plan updated');
    }
}

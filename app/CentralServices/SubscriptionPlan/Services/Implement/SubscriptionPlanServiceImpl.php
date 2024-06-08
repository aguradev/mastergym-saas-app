<?php

namespace App\CentralServices\SubscriptionPlan\Services\Implement;

use Exception;
use DebugBar\DebugBar;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Barryvdh\Debugbar\Facades\Debugbar as FacadesDebugbar;
use App\CentralServices\SubscriptionPlan\Services\Interfaces\SubscriptionPlanInterface;
use App\CentralServices\SubscriptionPlan\Repositories\Interfaces\SubscriptionPlanInterface as SubscriptionPlanInterfaceRepo;

class SubscriptionPlanServiceImpl implements SubscriptionPlanInterface
{
    private $SubscriptionPlanRepo;

    public function __construct(SubscriptionPlanInterfaceRepo $subscriptionPlan)
    {
        $this->SubscriptionPlanRepo = $subscriptionPlan;
    }
    public function GetAllSubscriptionPlans()
    {
        return $this->SubscriptionPlanRepo->GetAllSubscriptionPlans();
    }

    public function CreateSubscriptionPlanHandler(array $request)
    {
        try {
            DB::beginTransaction();

            $createPlanTenant = $this->SubscriptionPlanRepo->CreateSubscriptionPlan([
                "name" => $request["title"],
            ]);

            if (!$createPlanTenant) {
                throw new Exception("error when create plan tenant");
            }

            $createPlanTenantFirstVersion = $this->SubscriptionPlanRepo->CreateSubscriptionPlanVersion([
                "price_per_month" => (int) $request["price_per_month"],
                "price_per_year" => (int) $request["price_per_year"],
                "version" => "1",
            ], $createPlanTenant);

            if (!$createPlanTenantFirstVersion) {
                throw new Exception("error when create version plan");
            }

            $featuresId = collect($request["features"])->pluck("id");

            foreach ($featuresId as $id) {
                $addFeatures = $this->SubscriptionPlanRepo->AddSubscriptionFeatureInPlan($id, $createPlanTenantFirstVersion);
            }

            if (!$addFeatures) {
                throw new Exception("error when create plan tenant");
            }

            DB::commit();

            return true;
        } catch (\Throwable $th) {
            dd($th);
            FacadesDebugbar::error($th->getMessage());
            return false;
        }
    }
}

<?php

namespace App\CentralServices\SubscriptionPlan\Services\Implement;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CentralRequest\CreateFeaturePlanRequest;
use App\CentralServices\SubscriptionPlan\Services\Interfaces\FeaturePlanInterface;
use App\CentralServices\SubscriptionPlan\Repositories\Interfaces\FeaturePlanInterface as FeaturePlanRepo;
use Barryvdh\Debugbar\Facades\Debugbar;
use Exception;
use Illuminate\Support\Facades\Log;

class FeaturePlanServiceImpl implements FeaturePlanInterface
{
    private $featurePlanRepos;
    public function __construct(FeaturePlanRepo $featurePlan)
    {
        $this->featurePlanRepos = $featurePlan;
    }

    public function DeleteFeaturePlanHandler(string $id)
    {
        return $this->featurePlanRepos->DeletePlanFeature($id);
    }

    public function CreateFeaturePlanHandler(array $requestItems)
    {
        try {
            DB::beginTransaction();

            foreach ($requestItems as $item) {
                $tenantCreate = $this->featurePlanRepos->CreatePlanFeature($item['input_feature']);

                if (!$tenantCreate) {
                    break;
                    throw new Exception("failed to created feature plan.");
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
            return false;
        }

        return true;
    }
}

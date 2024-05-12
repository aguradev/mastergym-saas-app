<?php

namespace App\CentralServices\SubscriptionPlan\Repositories\Implement;

use App\CentralServices\SubscriptionPlan\Repositories\Interfaces\FeaturePlanInterface;
use App\Models\CentralModel\TenantPlanFeature;

class FeaturePlanRepoImpl implements FeaturePlanInterface
{
    private $FeaturePlanModel;

    public function __construct(TenantPlanFeature $planFeature)
    {
        $this->FeaturePlanModel = $planFeature;
    }

    public function UpdatePlanFeature($request, $id)
    {
        return $this->FeaturePlanModel->whereId($id)->update([
            "name" => $request['input_feature'],
            "updated_at" => now()
        ]);
    }

    public function DeletePlanFeature($id)
    {
        return $this->FeaturePlanModel::find($id)->delete();
    }

    public function CreatePlanFeature($request)
    {
        return $this->FeaturePlanModel::create([
            "name" => $request,
            "created_at" => now()
        ]);
    }
}

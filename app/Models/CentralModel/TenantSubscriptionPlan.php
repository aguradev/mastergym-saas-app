<?php

namespace App\Models\CentralModel;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantSubscriptionPlan extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;
    protected $table = "tenant_subscription_plan";
    protected $fillable = [
        "name",
        "price_per_year",
        "price_per_month",
        "created_at",
        "updated_at"
    ];

    public function PlanFeatrues()
    {
        return $this->belongsToMany(TenantPlanFeature::class, "tenant_subscription_plan_has_features", "subscription_plan_id", "feature_plan_id");
    }
}

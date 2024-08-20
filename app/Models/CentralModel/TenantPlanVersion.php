<?php

namespace App\Models\CentralModel;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantPlanVersion extends Model
{
    use HasFactory, HasUuids;
    protected $table = "tenant_plan_versions";

    protected $fillable = [
        "tenant_subscription_plan_id",
        "price_per_month",
        "price_per_year",
        "version",
        "status"
    ];

    protected $with = ["TenantSubscriptionPlan"];
    protected $appends = ["price_per_month_format", "price_per_year_format"];

    public function getPricePerMonthFormatAttribute()
    {
        return number_format($this->attributes["price_per_month"]);
    }
    public function getPricePerYearFormatAttribute()
    {
        return number_format($this->attributes["price_per_year"]);
    }

    public function TenantSubscriptionPlan()
    {
        return $this->belongsTo(TenantSubscriptionPlan::class, "tenant_subscription_plan_id", "id");
    }

    public function PlanFeatures()
    {
        return $this->belongsToMany(TenantPlanFeature::class, "tenant_plan_has_features", "subscription_plan_id", "feature_plan_id");
    }
}

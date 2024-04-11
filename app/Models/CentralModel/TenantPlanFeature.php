<?php

namespace App\Models\CentralModel;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantPlanFeature extends Model
{
    use HasFactory, HasUuids;
    public $timestamps = false;

    protected $table = "tenant_plan_features";
    protected $fillable = [
        "name",
        "created_at",
        "updated_at"
    ];

    public function SubscriptionPlans()
    {
        return $this->belongsToMany(TenantSubscriptionPlan::class, "tenant_subscription_plan_has_features", "feature_plan_id", "subscription_plan_id");
    }
}

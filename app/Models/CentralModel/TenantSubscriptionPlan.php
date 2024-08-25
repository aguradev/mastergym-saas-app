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
        "status",
        "created_at",
        "updated_at"
    ];

    public function TenantLogVersions()
    {
        return $this->hasMany(TenantPlanVersion::class, "tenant_subscription_plan_id", "id");
    }

    public function TenantSelectVersion()
    {
        return $this->hasOne(TenantPlanVersion::class, "tenant_subscription_plan_id", "id");
    }

    public function TenantVersionLatest()
    {
        return $this->hasOne(TenantPlanVersion::class, "tenant_subscription_plan_id", "id")->where("status", "ACTIVE");
    }
}

<?php

namespace App\Models\CentralModel;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected $appends = ["created_at_diff_human", "updated_at_diff_human", "date_created_format", "date_updated_format"];

    public function SubscriptionPlans()
    {
        return $this->belongsToMany(TenantSubscriptionPlan::class, "tenant_subscription_plan_has_features", "feature_plan_id", "subscription_plan_id");
    }

    public function getCreatedAtDiffHumanAttribute()
    {
        return Carbon::parse($this->attributes["created_at"])->diffForHumans();
    }
    public function getUpdatedAtDiffHumanAttribute()
    {
        return Carbon::parse($this->attributes["updated_at"])->diffForHumans();
    }

    public function getDateCreatedFormatAttribute()
    {
        return Carbon::parse($this->attributes["created_at"])->format("D, d M Y");
    }

    public function getDateUpdatedFormatAttribute()
    {
        return Carbon::parse($this->attributes["updated_at"])->format("D, d M Y");
    }
}

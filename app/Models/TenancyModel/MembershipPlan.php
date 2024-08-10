<?php

namespace App\Models\TenancyModel;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    use HasFactory, HasUuids;

    protected $table = "membership_plans";
    public $timestamps = false;
    protected $fillable = [
        "title",
        "period_type",
        "amount",
        "status",
        "created_at",
        "updated_at"
    ];

    public function MembershipFeatures()
    {
        return $this->belongsToMany(MembershipFeature::class, "memberships_has_features", "membership_id", "feature_id");
    }
}

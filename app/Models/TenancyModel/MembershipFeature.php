<?php

namespace App\Models\TenancyModel;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipFeature extends Model
{
    use HasFactory, HasUuids;

    protected $table = "membership_plan_features";
    public $timestamps = false;
    protected $fillable = [
        "title",
        "status",
        "created_at",
        "updated_at"
    ];

    protected $appends = ["created_at_diff_human", "updated_at_diff_human"];


    public function getCreatedAtDiffHumanAttribute()
    {
        return Carbon::parse($this->attributes["created_at"])->diffForHumans();
    }
    public function getUpdatedAtDiffHumanAttribute()
    {
        return Carbon::parse($this->attributes["updated_at"])->diffForHumans();
    }
}

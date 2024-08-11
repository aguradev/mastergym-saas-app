<?php

namespace App\Models\TenancyModel;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberTrainee extends Model
{
    use HasFactory, HasUuids;
    protected $table = "member_trainees";
    public $timestamps = false;

    public function MembershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class, "membership_id", "id");
    }

    public function User()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}

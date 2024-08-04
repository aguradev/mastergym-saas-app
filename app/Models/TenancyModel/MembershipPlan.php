<?php

namespace App\Models\TenancyModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    use HasFactory;

    protected $table = "membership_plans";
    protected $timestamps = false;
    protected $fillable = [
        "title",
        "period_type",
        "amount",
        "status",
        "created_at",
        "updated_at"
    ];
}

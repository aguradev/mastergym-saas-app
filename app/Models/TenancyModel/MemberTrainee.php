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

    protected $fillable = [
        "invoice_id",
        "user_id",
        "membership_id",
        "membership_start_date",
        "membership_expired_date",
        "fitness_goal",
        "total",
        "tax",
        "file_invoice_upload",
        "membership_status",
        "transaction_status",
        "created_at",
        "updated_at"
    ];

    public function MembershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class, "membership_id", "id");
    }

    public function User()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}

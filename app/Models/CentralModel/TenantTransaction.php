<?php

namespace App\Models\CentralModel;

use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class TenantTransaction extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;

    protected $table = "tenant_transactions";
    protected $keyType = "string";
    protected $with = ["PlanPurchase"];

    protected $fillable = [
        "tenant_plan_id",
        "full_name",
        "email",
        "phone_number",
        "total",
        "tax",
        "status",
        "address",
        "period_type",
        "transaction_token_access",
        "transaction_expired_at",
        "payment_type",
        "payment_gateway_url",
        "file_transfer_confirmation",
        "created_at"
    ];

    protected $appends = ["expired_countdown"];

    public function PlanPurchase()
    {
        return $this->hasOne(TenantPlanVersion::class, "id", "tenant_plan_id");
    }

    public function getExpiredCountdownAttribute()
    {
        $expired_at = $this->attributes['transaction_expired_at'];

        return $expired_at !== null ? Carbon::parse($expired_at)->diffForHumans(now(), CarbonInterface::DIFF_RELATIVE_TO_NOW, true, 2) : null;
    }
}

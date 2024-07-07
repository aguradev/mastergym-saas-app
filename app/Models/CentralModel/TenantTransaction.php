<?php

namespace App\Models\CentralModel;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class TenantTransaction extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;

    protected $table = "tenant_transactions";
    protected $keyType = "string";

    protected $fillable = [
        "tenant_plan_id",
        "full_name",
        "email",
        "phone_number",
        "total",
        "tax",
        "status",
        "transaction_token_access",
        "transaction_token_expired_at",
        "created_at"
    ];

    public function PlanPurchase()
    {
        return $this->hasOne(TenantPlanVersion::class, "id", "plan_tenant_id");
    }
}

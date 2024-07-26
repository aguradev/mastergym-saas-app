<?php

namespace App\Models\CentralModel;

use App\Models\Gym\Tenant;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantSubscription extends Model
{
    use HasFactory, HasUuids;
    protected $table = "tenants_subscription_lists";
    protected $with = ["Tenant", "Transaction"];

    protected $fillable = [
        "tenant_id",
        "invoice_transaction_id",
        "start_date",
        "due_date",
        "created_at",
        "updated_at"
    ];

    public function Tenant()
    {
        return $this->belongsTo(Tenant::class, "tenant_id", "id");
    }

    public function Transaction()
    {
        return $this->belongsTo(TenantTransaction::class, "invoice_transaction_id", "id");
    }
}

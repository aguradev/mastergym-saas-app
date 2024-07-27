<?php

namespace App\Models\CentralModel;

use App\Models\Gym\Tenant;
use Carbon\Carbon;
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

    protected $appends = ["date_and_time_start_date", "date_and_time_due_date"];

    public function Tenant()
    {
        return $this->belongsTo(Tenant::class, "tenant_id", "id");
    }

    public function Transaction()
    {
        return $this->belongsTo(TenantTransaction::class, "invoice_transaction_id", "id");
    }

    public function getDateAndTimeStartDateAttribute()
    {
        return Carbon::parse($this->attributes["start_date"])->format("d M Y, H:i");
    }

    public function getDateAndTimeDueDateAttribute()
    {
        return Carbon::parse($this->attributes["due_date"])->format("d M Y, H:i");
    }
}

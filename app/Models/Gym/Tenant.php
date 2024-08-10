<?php

namespace App\Models\Gym;

use App\Models\CentralModel\TenantSubscription;
use App\Models\CentralModel\TenantTransaction;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, HasUuids, HasFactory, Notifiable;

    public $timestamps = false;

    public static function getCustomColumns(): array
    {
        return [
            "id",
            "name",
            "email",
            "address",
            "virtual_account_number",
            "created_at",
            "updated_at"
        ];
    }

    public static function getDataColumn(): string
    {
        return "data";
    }

    public function TenantSubscription()
    {
        return $this->hasOne(TenantSubscription::class, 'tenant_id', "id");
    }
    public function TenantTransaction()
    {
        return $this->hasManyThrough(TenantTransaction::class, TenantSubscription::class, "tenant_id", "id", "id", "invoice_transaction_id");
    }
}

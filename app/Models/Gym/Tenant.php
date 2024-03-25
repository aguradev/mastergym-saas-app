<?php

namespace App\Models\Gym;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;


class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, HasUuids, HasFactory;

    public $timestamps = false;

    protected static function booted(): void
    {
        static::creating(function (Tenant $tenant) {
            $tenant->created_at = now();
        });

        static::updating(function (Tenant $tenant) {
            $tenant->updated_at = now();
        });
    }

    public static function getCustomColumns(): array
    {
        return [
            "id",
            "vendor",
            "email",
            "created_at",
            "updated_at"
        ];
    }

    public static function getDataColumn(): string
    {
        return "data";
    }
}

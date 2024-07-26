<?php

namespace App\Models\Gym;

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
            "created_at",
            "updated_at"
        ];
    }

    public static function getDataColumn(): string
    {
        return "data";
    }
}

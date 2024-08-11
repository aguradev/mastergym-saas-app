<?php

namespace App\Enums;

enum TenantRolesEnum: string
{
    case SUPERADMIN = "Super admin";
    case ADMIN = "Admin";
    case MEMBER = "Member";

    public function label(): string
    {
        return match ($this) {
            static::SUPERADMIN => 'Super admin',
            static::ADMIN => "Admin",
            static::MEMBER => "Member",
        };
    }
}

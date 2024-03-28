<?php

namespace App\Enums;

enum CentralRoles: string
{
    case SUPERADMIN = "Super admin";
    case ADMIN = "Admin";
    case OWNERVENDOR = "Owner vendor";

    public function label(): string
    {
        return match ($this) {
            static::SUPERADMIN => 'Super admin',
            static::ADMIN => 'Admin',
            static::OWNERVENDOR => 'Owner vendor'
        };
    }
}

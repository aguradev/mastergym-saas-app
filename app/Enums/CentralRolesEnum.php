<?php

namespace App\Enums;

enum CentralRolesEnum: string
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

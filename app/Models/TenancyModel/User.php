<?php

namespace App\Models\TenancyModel;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class User extends Model
{
    use HasFactory, HasRoles, HasUuids;

    protected $table = "tenant_users";
    protected $guard = "tenant-web";
    protected $fillable = [
        "credential_id",
        "first_name",
        "last_name",
        "profile_url",
        "bio",
    ];
}

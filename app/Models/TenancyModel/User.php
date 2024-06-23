<?php

namespace App\Models\TenancyModel;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "tenant_users";
    protected $guard = "tenant-web";
    protected $fillable = [
        "first_name",
        "last_name",
        "profile_url",
        "bio",
    ];
}

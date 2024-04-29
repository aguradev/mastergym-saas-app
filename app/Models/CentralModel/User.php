<?php

namespace App\Models\CentralModel;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class User extends Model
{
    use HasFactory, HasRoles, HasUuids;

    protected $table = "central_users";
    protected $guard_name = "central-web";
    protected $with = ["Roles"];
    protected $fillable = [
        "first_name",
        "last_name",
        "profile_url",
        "bio",
    ];
}

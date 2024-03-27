<?php

namespace App\Models\CentralModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class User extends Model
{
    use HasFactory, HasRoles;

    protected $table = "central_users";
}

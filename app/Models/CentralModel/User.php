<?php

namespace App\Models\CentralModel;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
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

    protected $appends = ["profile_image"];

    public function getProfileImageAttribute()
    {
        $profile_image_path = "assets/images/profile/";
        return $this->attributes["profile_url"] === "profile.png" ? asset("assets/images/profile/profile.png") : Storage::url($profile_image_path .  $this->attributes["profile_url"]);
    }
}

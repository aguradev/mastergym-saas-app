<?php

namespace App\Models\TenancyModel;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, HasRoles, HasUuids, HasPermissions;

    protected $table = "tenant_users";
    protected $guard_name = "tenant-web";
    protected $appends = ["full_name", "profile_image"];
    protected $keyType = "string";

    protected $fillable = [
        "username",
        'email',
        'password',
        "first_name",
        "last_name",
        "profile_url",
        "phone_number"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getFulLNameAttribute()
    {
        return $this->attributes["first_name"] . " " . $this->attributes["last_name"];
    }

    public function getProfileImageAttribute()
    {
        $profile_image_path = "tenant-" . tenant("id") . "/assets/images/profile/";
        return $this->attributes["profile_url"] === "profile.png" ? asset("images/profile/profile.png") : Storage::url($profile_image_path .  $this->attributes["profile_url"]);
    }

    public function MemberTrainees()
    {
        return $this->hasMany(MemberTrainee::class, "user_id", "id");
    }

    public function MemberTrainessLatest()
    {
        return $this->hasOne(MemberTrainee::class, "user_id", "id")->latest();
    }
}

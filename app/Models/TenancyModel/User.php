<?php

namespace App\Models\TenancyModel;

use App\Models\Auth\TenantCredential;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Model
{
    use HasFactory, HasRoles, HasUuids;

    protected $table = "tenant_users";
    protected $guard_name = "tenant-web";
    protected $appends = ["full_name", "profile_image"];

    protected $fillable = [
        "credential_id",
        "first_name",
        "last_name",
        "profile_url",
        "phone_number"
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

    public function TenantCredential()
    {
        return $this->belongsTo(TenantCredential::class, "credential_id", "id");
    }

    public function MemberTrainees()
    {
        return $this->hasMany(MemberTrainee::class, "user_id", "id");
    }
}

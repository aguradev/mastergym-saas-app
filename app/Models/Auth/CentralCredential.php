<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class CentralCredential extends Authenticatable
{
    use HasFactory, HasUuids, HasApiTokens, Notifiable;

    protected $keyType = "string";
    protected $fillable = [
        "username",
        "email",
        "password"
    ];
    protected $hidden = ["password", "remember_token"];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}

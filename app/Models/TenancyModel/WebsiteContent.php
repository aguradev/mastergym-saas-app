<?php

namespace App\Models\TenancyModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteContent extends Model
{
    use HasFactory;

    protected $table = "website_content";
    protected $fillable = [
        "nav",
        "hero",
        "cta",
        "service",
        "membership",
        "testimony",
        "footer"
    ];
}
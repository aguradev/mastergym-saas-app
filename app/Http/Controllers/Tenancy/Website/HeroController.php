<?php

namespace App\Http\Controllers\Tenancy\Website;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\WebsiteContent;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function showHero()
    {
        return WebsiteContent::select("hero")->latest()->first();
    }
}

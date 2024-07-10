<?php

namespace App\Http\Controllers\Tenancy\Website;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\WebsiteContent;
use Illuminate\Http\Request;

class NavController extends Controller
{
    public function showNav()
    {
        return WebsiteContent::select("nav")->latest()->first();
    }
}

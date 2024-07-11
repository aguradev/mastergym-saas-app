<?php

namespace App\Http\Controllers\Tenancy\Website;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\WebsiteContent;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function showPricing()
    {
        return WebsiteContent::select("membership")->latest()->first();
    }
}

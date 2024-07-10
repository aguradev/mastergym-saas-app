<?php

namespace App\Http\Controllers\Tenancy\Website;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\WebsiteContent;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function showFooter()
    {
        return WebsiteContent::select("footer")->latest()->first();
    }
}

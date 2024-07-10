<?php

namespace App\Http\Controllers\Tenancy\Website;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\WebsiteContent;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    public function showTestimony()
    {
        return WebsiteContent::select("testimony")->latest()->first();
    }
}

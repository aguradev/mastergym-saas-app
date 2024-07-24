<?php

namespace App\Http\Controllers\Tenancy\Website;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\WebsiteContent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestimonyController extends Controller
{
    public function showTestimony()
    {
        return WebsiteContent::select("testimony")->latest()->first();
    }

    public function fetchTestimonyData()
    {
        $unparsedTestimony = WebsiteContent::select("testimony")->latest()->first();
        $testi = json_decode($unparsedTestimony->testimony);

        return Inertia::render('dashboard/tenant_page/website_content_page/Testimony', compact('testi'));
    }
}
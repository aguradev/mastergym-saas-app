<?php

namespace App\Http\Controllers\Tenancy\Website;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\WebsiteContent;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CtaController extends Controller
{
    public function showCallToAction()
    {
        return WebsiteContent::select("cta")->latest()->first();
    }
}

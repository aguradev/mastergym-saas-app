<?php

namespace App\Http\Controllers\MainPlatform\FrontPage;

use App\Http\Controllers\Controller;
use App\Models\CentralModel\TenantSubscriptionPlan;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LandingPageController extends Controller
{
    public function __invoke()
    {
        $getPricingActive = TenantSubscriptionPlan::with(["TenantVersionLatest" => function ($query) {
            return $query->first();
        }])->get();

        Debugbar::debug($getPricingActive);
        return Inertia::render("landing_page/central_page/MainMenu", [
            "pricing_lists" => $getPricingActive
        ]);
    }
}

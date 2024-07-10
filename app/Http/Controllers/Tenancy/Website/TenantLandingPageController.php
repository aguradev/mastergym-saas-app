<?php

namespace App\Http\Controllers\Tenancy\Website;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Tenancy\Website\NavController;
use App\Http\Controllers\Tenancy\Website\HeroController;
use App\Http\Controllers\Tenancy\Website\CtaController;
use App\Http\Controllers\Tenancy\Website\ServiceController;
use App\Http\Controllers\Tenancy\Website\PricingController;
use App\Http\Controllers\Tenancy\Website\TestimonyController;
use App\Http\Controllers\Tenancy\Website\FooterController;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TenantLandingPageController extends Controller
{
    public function ShowAllWebsiteContent()
    {
        $navController = new NavController();
        $heroController = new HeroController();
        $ctaController = new CtaController();
        $serviceController = new ServiceController();
        $pricingController = new PricingController();
        $testimonyController = new TestimonyController();
        $footerController = new FooterController();


        return Inertia::render('landing_page/tenant_page/TenantHome', [
            'nav' => $navController->showNav()->nav,
            'hero' => $heroController->showHero()->hero,
            'cta' => $ctaController->showCallToAction()->cta,
            'service' => $serviceController->showService()->service,
            'pricing' => $pricingController->showPricing()->membership,
            'testimony' => $testimonyController->showTestimony()->testimony,
            'footer' => $footerController->showFooter()->footer,
        ]);
    }
}

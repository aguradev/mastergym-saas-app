<?php

namespace App\Http\Controllers\Tenancy\Website;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Tenancy\Website\CtaController;
use App\Http\Controllers\Tenancy\Website\ServiceController;
use App\Http\Controllers\Tenancy\Website\PricingController;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TenantLandingPageController extends Controller
{
    public function ShowAllWebsiteContent()
    {
        $ctaController = new CtaController();
        $serviceController = new ServiceController();
        $pricingController = new PricingController();

        return Inertia::render('landing_page/tenant_page/TenantHome', [
            'cta' => $ctaController->showCallToAction()->cta,
            'service' => $serviceController->showService()->service,
            'pricing' => $pricingController->showPricing()->membership,
        ]);
    }

    // public function ShowAllWebsiteContent()
    // {
    //     $navController = new NavController();
    //     $heroController = new HeroController();
    //     $ctaController = new CtaController();
    //     $serviceController = new ServiceController();
    //     $testimonyController = new TestimonyController();
    //     $footerController = new FooterController();

    //     return Inertia::render('landing_page/tenant_page/TenantHome', [
    //         'nav' => $navController->getNavData(),
    //         'hero' => $heroController->getHeroData(),
    //         'cta' => $ctaController->getCtaData(),
    //         'service' => $serviceController->getServiceData(),
    //         'testimony' => $testimonyController->getTestimonyData(),
    //         'footer' => $footerController->getFooterData(),
    //     ]);
    // }
}

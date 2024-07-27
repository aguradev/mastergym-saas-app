<?php

use App\Http\Controllers\Tenancy\Website\CtaController;
use App\Http\Controllers\Tenancy\Website\FooterController;
use App\Http\Controllers\Tenancy\Website\HeroController;
use App\Http\Controllers\Tenancy\Website\ServiceController;
use App\Http\Controllers\Tenancy\Website\TestimonyController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//content website routes
Route::prefix("website")->group(function () {
    Route::get("/", function () {
        return Inertia::render(
            "dashboard/tenant_page/website_content_page/ContentOverview"
        );
    })->name('website.overview');

    Route::get("/hero", [HeroController::class, 'fetchHeroData'])->name('website.hero');
    Route::put("/hero", [HeroController::class, 'updateHeroData'])->name('website.hero.update');

    Route::get("/cta", [CtaController::class, 'fetchCtaData'])->name('website.cta');
    Route::put("/cta", [CtaController::class, 'updateCtaData'])->name('website.cta.update');

    Route::get("/service", [ServiceController::class, 'fetchServiceData'])->name('website.service');
    Route::put("/service", [ServiceController::class, 'updateServiceData'])->name('website.service.update');

    Route::get("/testimony", [TestimonyController::class, 'fetchTestimonyData'])->name('website.testimony');
    Route::put("/testimony", [TestimonyController::class, 'updateTestimonyData'])->name('website.testimony.update');

    Route::get("/footer", [FooterController::class, 'fetchFooterData'])->name('website.footer');
    Route::put("/footer", [FooterController::class, 'updateFooterData'])->name('website.footer.update');
});

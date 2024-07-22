<?php

use App\Http\Controllers\Tenancy\Website\CtaController;
use App\Http\Controllers\Tenancy\Website\HeroController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

//content website routes
Route::prefix("dashboard/website")->group(function () {
    Route::get("/", function () {
        return Inertia::render(
            "dashboard/tenant_page/website_content_page/ContentOverview"
        );
    })->name('website.overview');

    Route::get("/hero", [HeroController::class, 'fetchHeroData'])->name('website.hero');
    Route::put("/hero", [HeroController::class, 'updateHeroData'])->name('website.hero.update');

    Route::get("/cta", [CtaController::class, 'fetchCtaData'])->name('website.cta');
    Route::put("/cta", [CtaController::class, 'updateCtaData'])->name('website.cta.update');

    Route::get("/service", function () {
        return Inertia::render(
            "dashboard/tenant_page/website_content_page/Service"
        );
    })->name('website.service');

    Route::get("/testimony", function () {
        return Inertia::render(
            "dashboard/tenant_page/website_content_page/Testimony"
        );
    })->name('website.testimony');

    Route::get("/footer", function () {
        return Inertia::render(
            "dashboard/tenant_page/website_content_page/Footer"
        );
    })->name('website.footer');
});

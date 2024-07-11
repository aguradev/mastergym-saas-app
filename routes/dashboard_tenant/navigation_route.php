<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get("/dashboard", function () {
//     return Inertia::render("dashboard/tenant_page/MainMenu", [
//         "vendor" => tenant("vendor")
//     ]);
// });

Route::prefix("/dashboard")->group(function () {
    Route::get("/", function () {
        return Inertia::render(
            'dashboard/tenant_page/MainMenu',
            ["vendor" => tenant("vendor")]
        );
    });
    Route::get("/website", function () {
        return Inertia::render(
            "dashboard/tenant_page/website_content_page/ContentOverview"
        );
    })->name('website.overview');

    Route::get("/website/cta", function () {
        return Inertia::render(
            "dashboard/tenant_page/website_content_page/CtaForm"
        );
    })->name('website.cta');

    Route::get("/website/hero", function () {
        return Inertia::render(
            "dashboard/tenant_page/website_content_page/HeroForm"
        );
    })->name('website.hero');
});

<?php

declare(strict_types=1);

use App\Http\Controllers\Tenancy\Website\TenantLandingPageController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get("/", [TenantLandingPageController::class, 'showAllWebsiteContent'])->name('tenant.landingPage');

    require __DIR__ . "/dashboard_tenant/authentication_route.php";

    Route::prefix("/dashboard")->middleware(['auth.tenant'])->group(function () {
        require __DIR__ . "/dashboard_tenant/navigation_route.php";
        require __DIR__ . "/dashboard_tenant/content_website_route.php";
        require __DIR__ . "/dashboard_tenant/user_management_route.php";
    });
});

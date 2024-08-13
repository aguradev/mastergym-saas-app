<?php

declare(strict_types=1);

use App\Http\Controllers\AbortPageController;
use App\Http\Controllers\Tenancy\Dashboard\Auth\AuthenticationController;
use App\Http\Controllers\Tenancy\Dashboard\TenantConfiguration;
use App\Http\Controllers\Tenancy\Website\TenantLandingPageController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
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

    //temp_register_route
    Route::get("/register", fn() => Inertia::render("auth/tenant_page/Register"))->name('tenant.register');

    Route::prefix("abort")->controller(AbortPageController::class)->group(function () {
        Route::get("/unauthorization", 'UnauthorizationPage')->name("tenant.abort.unauthorization");
    });

    require __DIR__ . "/dashboard_tenant/authentication_route.php";

    Route::prefix("/dashboard")->middleware(['auth.tenant'])->group(function () {
        require __DIR__ . "/dashboard_tenant/navigation_route.php";

        Route::middleware(['role:Super admin|Admin,tenant-web', 'permission:access_dashboard_menu_tenant,tenant-web'])->group(function () {
            require __DIR__ . "/dashboard_tenant/content_website_route.php";
            require __DIR__ . "/dashboard_tenant/user_management_route.php";
            require __DIR__ . "/dashboard_tenant/membership_route.php";
        });

        Route::controller(TenantConfiguration::class)->middleware(['role:Super admin,tenant-web'])->prefix("tenant-configuration")->group(function () {
            Route::put("/update/{tenant}", "UpdateTenantSubmmited")->name("tenant-configuration.update");
        });
        Route::post("/logout", [AuthenticationController::class, "LogoutDashboard"])->name("tenant-dashboard.logout");
    });
});

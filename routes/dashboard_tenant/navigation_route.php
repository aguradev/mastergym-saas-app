<?php

declare(strict_types=1);

use App\Http\Controllers\Tenancy\Dashboard\DashboardController;
use App\Http\Controllers\Tenancy\Website\HeroController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::controller(DashboardController::class)->group(function () {
    Route::get("/", "Overview")->name('tenant-dashboard.overview-page');
    Route::get("/setting/tenant-subscription", "Setting")->name('tenant-dashboard.setting-page');
});

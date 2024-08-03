<?php

declare(strict_types=1);

use App\Http\Controllers\Tenancy\Dashboard\DashboardController;
use App\Http\Controllers\Tenancy\Website\HeroController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get("/", DashboardController::class)->name('tenant-dashboard.overview-page');

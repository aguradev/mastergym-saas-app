<?php

use App\Http\Controllers\MainPlatform\Dashboard\Nav\NavigationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::controller(NavigationController::class)->group(function () {
    Route::get("/", "DashboardPage")->name('central-dashboard.main');
});

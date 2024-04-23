<?php

use App\Http\Controllers\MainPlatform\Dashboard\Nav\NavigationController;
use Illuminate\Support\Facades\Route;

// Route::get("/", fn () => "Hello world");
Route::controller(NavigationController::class)->group(function () {
    Route::get("/", "DashboardPage")->name('central-dashboard.main');
    Route::get("/subscriptions", "SubscriptionPage")->name('central-dashboard.subscriptions');
});

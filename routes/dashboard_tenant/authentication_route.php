<?php

use App\Http\Controllers\Tenancy\Dashboard\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/login', 'DashboardAuthenticationPage')->name('tenant.dashboard-loginpage')->middleware('guest:tenant-web');
    Route::post('/login', 'Authenticable')->name('tenant.authenticable-dashboard');
});

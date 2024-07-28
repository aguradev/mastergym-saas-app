<?php

use App\Http\Controllers\Tenancy\Dashboard\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthenticationController::class, 'DashboardAuthenticationPage'])->name('tenant.dashboard-loginpage')->middleware('guest:tenant-web');
Route::post('/login', [AuthenticationController::class, 'Authenticable'])->name('tenant.authenticable-dashboard');

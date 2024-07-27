<?php

use App\Http\Controllers\Tenancy\Dashboard\Users\AuthenticationController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthenticationController::class, 'DashboardAuthenticationPage'])->name('tenant.dashboard-loginpage');

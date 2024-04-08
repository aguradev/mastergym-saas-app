<?php

use App\Http\Controllers\MainPlatform\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::prefix("dashboard")->group(function () {
    Route::middleware(["redirectAuth:central-web"])->controller(AuthController::class)->group(function () {
        route::get("/login", "AuthPage")->name("login");
        route::post("/login", "Authenticable")->name("auth.submit");
    });

    Route::middleware(["auth", "role:Super admin|Admin,central-web"])->group(function () {
        Route::post("/logout", [AuthController::class, 'Logout'])->name("central-dashboard.logout");
        require_once __DIR__ . "/dashboard_central/navigation_route.php";
    });
});

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


Route::get("/", fn () => Inertia::render("views/landing_page/central_page/MainMenu"))->name('main.dashboard');
Route::get("/signup", fn () => Inertia::render("views/landing_page/central_page/SignUp"))->name('main.signup');
Route::get("/login", fn () => Inertia::render("views/landing_page/central_page/Login"))->name('main.login');
Route::get("/setuptenant", fn () => Inertia::render("views/landing_page/central_page/SetupTenant"))->name('main.setuptenant');
Route::get("/checkouttenant", fn () => Inertia::render("views/landing_page/central_page/CheckoutTenant"))->name('main.checkouttenant');


Route::prefix("dashboard")->group(function () {
    Route::middleware(["redirectAuth:central-web"])->controller(AuthController::class)->group(function () {
        route::get("/login", "AuthPage")->name("login");
        route::post("/login", "Authenticable")->name("auth.submit");
    });

    Route::middleware(["auth"])->group(function () {
        require_once __DIR__ . "/dashboard_central/navigation_route.php";
    });
});

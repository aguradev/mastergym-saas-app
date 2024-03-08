<?php

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

Route::get("/", fn () => to_route('main.dashboard'));

Route::prefix("dashboard")->group(function () {
    require_once __DIR__ . "/dashboard_main_platform/navigation_route.php";
});

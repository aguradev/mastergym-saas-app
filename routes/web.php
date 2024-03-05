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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix("dashboard")->group(function () {
    Route::get("/", fn () => Inertia::render("views/dashboard/mainplatform_page/MainMenu"))->name('main.dashboard');
    Route::get("/subscription", fn () => Inertia::render("views/dashboard/mainplatform_page/Subscription_page"))->name('main.dashboard.subscription');
});

<?php

use App\Http\Controllers\Tenancy\Dashboard\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix("profile")->controller(ProfileController::class)->group(function () {
    Route::get("/", "ProfilePage")->name("tenant-dashboard.profile");
    Route::post("/{tenantCredential}/update", "ProfileUpdate")->name("tenant-dashboard.profile.update");
});

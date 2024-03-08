<?php

declare(strict_types=1);

use App\Models\Auth\Credential;
use App\Models\Gym\Tenant;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::prefix("dashboard")->group(function () {
    Route::get("/", function () {

        return Inertia::render("views/dashboard/vendor_page/MainMenu", [
            "vendor__name" => tenant("vendor_name")
        ]);
    });
});

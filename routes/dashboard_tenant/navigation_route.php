<?php

declare(strict_types=1);

use App\Http\Controllers\Tenancy\Website\HeroController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::prefix("/dashboard")->group(function () {
    Route::get("/", function () {
        return Inertia::render(
            'dashboard/tenant_page/MainMenu',
            ["vendor" => tenant("vendor")]
        );
    });
});

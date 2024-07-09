<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get("/dashboard", function () {
    return Inertia::render("dashboard/tenant_page/MainMenu", [
        "vendor" => tenant("vendor")
    ]);
});

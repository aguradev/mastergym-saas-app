<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get("/", function () {
    return Inertia::render("views/dashboard/vendor_page/MainMenu", [
        "vendor" => tenant("vendor")
    ]);
});

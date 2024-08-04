<?php

use App\Http\Controllers\Tenancy\Dashboard\Memberships\MembershipFeatureController;
use App\Http\Controllers\Tenancy\Dashboard\Memberships\MembershipPlanController;
use Illuminate\Support\Facades\Route;

Route::prefix("membership")->group(function () {
    Route::controller(MembershipPlanController::class)->group(function () {
        Route::get("/plans", "Page")->name("tenant-dashboard.membership.plan-page");
        Route::get("/plan/{membershipPlan}", "DetailPage")->name("tenant-dashboard.membership.detail");
        Route::post("/plan", "CreateMembershipPlan")->name("tenant-dashboard.membership.create");
        Route::put("/plan/{membershipPlan}", "UpdateMembershipPlan")->name("tenant-dashboard.membership.update");
    });

    Route::controller(MembershipFeatureController::class)->group(function () {
        Route::get("/features", "Page")->name("tenant-dashboard.membership.feature-page");
        Route::post("/feature", "CreateFeature")->name("tenant-dashboard.membership.create-feature");
        Route::delete("/feature/{membershipFeature}", "DeleteFeature")->name("tenant-dashboard.membership.delete-feature");
        Route::put("/feature/update/{membershipFeature}", "UpdateFeature")->name("tenant-dashboard.membership.update-feature");
    });
});

<?php

use App\Http\Controllers\MainPlatform\Dashboard\Subscriptions\FeaturePlanController;
use App\Http\Controllers\MainPlatform\Dashboard\Subscriptions\SubscriptionPlanController;
use Illuminate\Support\Facades\Route;


Route::prefix("subscriptions")->group(function () {

    Route::controller(SubscriptionPlanController::class)->prefix('plans')->group(function () {
        Route::get("/", 'PlanTablePage')->name('plans.table');
    });

    Route::controller(FeaturePlanController::class)->prefix("plan-feature")->group(function () {
        Route::get("/", 'FeaturePlanTable')->name('plan_feature.table');
        Route::get('/{tenantPlanFeature}/edit-form', 'editForm')->name('plan_feature.edit-form');
        Route::post("/", 'CreateFeaturePlan')->name("plan_feature.create");
    });
});
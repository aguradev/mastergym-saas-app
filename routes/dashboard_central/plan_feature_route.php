<?php

use App\Http\Controllers\MainPlatform\Dashboard\Subscriptions\FeaturePlanController;
use Illuminate\Support\Facades\Route;


Route::controller(FeaturePlanController::class)->prefix("plan-feature")->group(function () {
    Route::post("/create", 'CreateFeaturePlan')->name("plan_feature.create");
});

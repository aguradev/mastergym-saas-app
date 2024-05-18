<?php

use App\Http\Controllers\MainPlatform\Dashboard\Subscriptions\FeaturePlanController;
use App\Http\Controllers\MainPlatform\Dashboard\Subscriptions\TenantPlanController;
use Illuminate\Support\Facades\Route;


Route::prefix("subscriptions")->group(function () {

    Route::controller(TenantPlanController::class)->prefix('plan-tenant')->group(function () {
        Route::get("/", 'PlanTablePage')->name('plan_tenant.table');
    });

    Route::controller(FeaturePlanController::class)->prefix("plan-feature")->group(function () {
        Route::get("/", 'FeaturePlanTable')->name('plan_feature.table');
        Route::get('api/get-all', 'AllFeaturePlan')->name('plan_feature.json.all');
        Route::get('api/{tenantPlanFeature}', 'featurePlanDetail')->name('plan_feature.json.detail')->middleware('redirect_json_access');
        Route::delete('{tenantPlanFeature}', 'DeleteFeature')->name('plan_feature.delete');
        Route::put('/{tenantPlanFeature}/edit-form', 'UpdateFeature')->name('plan_feature.update');
        Route::post("/", 'CreateFeaturePlan')->name("plan_feature.create");
    });
});

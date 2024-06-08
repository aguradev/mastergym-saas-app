<?php

use App\Http\Controllers\MainPlatform\Dashboard\Nav\NavigationController;
use App\Http\Controllers\MainPlatform\Dashboard\TenantPlan\FeaturePlanController;
use App\Http\Controllers\MainPlatform\Dashboard\TenantPlan\TenantPlanController;
use Illuminate\Support\Facades\Route;


Route::prefix("plan")->group(function () {
    Route::get('/overview', [NavigationController::class, 'PlanOverviewMenu'])->name("plan.overview");

    Route::controller(TenantPlanController::class)->prefix('pricing')->group(function () {
        Route::get("/", 'PlanTablePage')->name('plan_tenant.table');
        Route::post("/", 'CreatePlanTenant')->name('plan_tenant.create');
        Route::middleware("redirect_json_access")->group(function () {
            Route::get("api/{planTenant}", "GetPlanDetail")->name('plan_tenant.json.detail');
        });
    });

    Route::controller(FeaturePlanController::class)->prefix("features")->group(function () {
        Route::get("/", 'FeaturePlanTable')->name('plan_feature.table');
        Route::get('api/get-all', 'AllFeaturePlan')->name('plan_feature.json.all');
        Route::get('api/{tenantPlanFeature}', 'featurePlanDetail')->name('plan_feature.json.detail')->middleware('redirect_json_access');
        Route::delete('{tenantPlanFeature}', 'DeleteFeature')->name('plan_feature.delete');
        Route::put('/{tenantPlanFeature}/edit-form', 'UpdateFeature')->name('plan_feature.update');
        Route::post("/", 'CreateFeaturePlan')->name("plan_feature.create");
    });
});

<?php

use App\Http\Controllers\Tenancy\Dashboard\Trainess\UserTrainessController;
use Illuminate\Support\Facades\Route;

Route::prefix("trainess")->controller(UserTrainessController::class)->group(function () {
    Route::get("/", "TrainessListPage")->name("tenant-dashboard.trainess");
    Route::put("/{memberTrainee}/update", "UpdateMembershipTrainessStatus")->name("tenant-dashboard.trainess.update");
});

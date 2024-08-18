<?php

use App\Http\Controllers\Tenancy\Member\MemberSubcribeMembershipController;
use Illuminate\Support\Facades\Route;

Route::controller(MemberSubcribeMembershipController::class)->prefix("member-subscription")->group(function () {
    Route::get("/", "MemberSubscriptionPage")->name("tenant-dashboard.member.member-subscription");
    Route::post("/processing-checkout", "MemberCheckoutSubmmited")->name("membership.processing-checkout");
});

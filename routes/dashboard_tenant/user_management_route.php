<?php

use App\Http\Controllers\Tenancy\Dashboard\UserManagement\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('management')->controller(UsersController::class)->group(function () {
    Route::get('/users', 'UsersManagementPage')->name('tenant-dashboard.user-management.users');
    Route::post('/user', 'CreateUser')->name('tenant-dashboard.user-management.create-user');
    Route::get("/roles", "RolesManagementPage")->name('tenant-dashboard.user-management.roles');
    Route::post("/role", "CreateRole")->name('tenant-dashboard.user-management.create-role');
});

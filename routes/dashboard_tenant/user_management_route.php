<?php

use App\Http\Controllers\Tenancy\Dashboard\UserManagement\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('management')->controller(UsersController::class)->group(function () {
    Route::get('/users', 'UsersManagementPage')->name('tenant-dashboard.user-management.users');
    Route::post('/user', 'CreateUser')->name('tenant-dashboard.user-management.create-user');
    Route::post('/user/{user}', 'UpdateUser')->name('tenant-dashboard.user-management.update-user');

    Route::middleware(['role:Super admin,tenant-web'])->group(function () {
        Route::get("/roles", "RolesManagementPage")->name('tenant-dashboard.user-management.roles');
        Route::post("/role", "CreateRole")->name('tenant-dashboard.user-management.create-role');
        Route::post("/role/{id}/add-permissions", "AssignPermissions")->name('tenant-dashboard.user-management.assign-permission');
        Route::delete("/role/{id}", "DeleteRole")->name('tenant-dashboard.user-management.delete-role');
    });
});

<?php

use App\Http\Controllers\MainPlatform\Dashboard\Transaction\TransactionController;
use Illuminate\Support\Facades\Route;

Route::prefix('transactions')->controller(TransactionController::class)->group(function () {
    Route::get("/", "TransactionListPage")->name('central-dashboard.transactions.lists');
});

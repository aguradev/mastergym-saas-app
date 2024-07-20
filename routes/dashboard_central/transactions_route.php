<?php

use App\Http\Controllers\MainPlatform\Dashboard\Transaction\TransactionController;
use Illuminate\Support\Facades\Route;

Route::prefix('transactions')->controller(TransactionController::class)->group(function () {
    Route::get("/", "TransactionListPage")->name('central-dashboard.transactions.lists');
    Route::get("/invoice-pdf/{transaction}", "PrintInvoicePDF")->name('central-dashboard.transactions.invoice-pdf');
    Route::middleware("redirect_json_access")->group(function () {
        Route::get("api/{transaction}", "GetTransactionDetail")->name('central-dashboard.transaction.json.detail');
    });
});

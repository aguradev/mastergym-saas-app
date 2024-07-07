<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\Transaction;

use App\Http\Controllers\Controller;
use App\Models\CentralModel\TenantTransaction;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function TransactionListPage()
    {
        $transactions = TenantTransaction::simplePaginate(10);
        Debugbar::debug($transactions);
        return Inertia::render("dashboard/central_page/transaction_page/Index", compact('transactions'));
    }
}

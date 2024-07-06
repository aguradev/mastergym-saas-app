<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function TransactionListPage()
    {
        return Inertia::render("dashboard/central_page/transaction_page/Index");
    }
}

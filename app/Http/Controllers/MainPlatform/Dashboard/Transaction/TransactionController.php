<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\Transaction;

use App\Http\Controllers\Controller;
use App\Models\CentralModel\TenantTransaction;
use Barryvdh\Debugbar\Facades\Debugbar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function TransactionListPage(Request $request)
    {
        $searchResult = $request->query("search");
        $typeSearch = $request->query("type");
        $transactions = null;

        $transactions = TenantTransaction::query()->when($searchResult, function ($query) use ($searchResult, $typeSearch) {
            switch ($typeSearch) {
                case "EMAIL":
                    $query->where("email", "LIKE", '%' . $searchResult . '%');
                    break;
                default:
                    break;
            }
        })->paginate(5);

        Debugbar::debug($transactions);
        return Inertia::render("dashboard/central_page/transaction_page/Index", compact('transactions'));
    }

    public function GetTransactionDetail(TenantTransaction $transaction)
    {
        if (is_null($transaction)) {
            return response()->json([
                "error" => "tenant transaction not found"
            ])->setStatusCode(404);
        }

        return response()->json($transaction)->setStatusCode(200);
    }

    public function PrintInvoicePDF(TenantTransaction $transaction)
    {
        $loadInvoicePDF = Pdf::loadView('pdf.transaction-invoice', compact('transaction'));

        return $loadInvoicePDF->stream();
    }
}

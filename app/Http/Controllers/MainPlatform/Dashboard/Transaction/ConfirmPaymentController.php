<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\Transaction;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CentralModel\TenantTransaction;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ConfirmPaymentController extends Controller
{
    public function ConfirmPage()
    {
        return Inertia::render("transactions/confirm", [
            "message" => "Transaction Success"
        ]);
    }
    public function MidtransSuccessConfirmation(Request $request)
    {
        if (!session()->has('last_history_transaction_id')) {
            return to_route('central.landingPage');
        }

        $transactionId = session('last_history_transaction_id');

        try {
            $findTransactionId = TenantTransaction::where("id", $transactionId)->first();

            $generateToken = Str::random(64);

            $findTransactionId->update([
                "status" => "PAID",
                "transaction_token_access" => Crypt::encrypt($generateToken),
                "transaction_expired_at" => null,
            ]);
        } catch (Exception $err) {
            Log::error($err->getMessage());
            return to_route('central.landingPage');
        }

        return to_route('central.landingPage');
    }
}

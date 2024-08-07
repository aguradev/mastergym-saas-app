<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\Transaction;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\InvoicePaidMail;
use App\Mail\SendingTenantRegistration;
use App\Models\CentralModel\TenantTransaction;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class ConfirmPaymentController extends Controller
{
    public function ConfirmPage()
    {
        $getConfirmMessage = session('confirm_message');

        if (is_null($getConfirmMessage)) {
            return to_route('central.landingPage');
        }

        return Inertia::render("transactions/confirm", [
            "status" => $getConfirmMessage["status"],
            "title" => $getConfirmMessage["title"],
            "message" => $getConfirmMessage["message"],
        ]);
    }
    public function MidtransSuccessConfirmation(Request $request)
    {
        if (!session()->has('last_history_transaction_id')) {
            return to_route('central.landingPage');
        }

        $transactionId = session('last_history_transaction_id');

        try {
            $findTransactionId = TenantTransaction::with(["PlanPurchase.TenantSubscriptionPlan"])->where("id", $transactionId)->first();
            $generateToken = Str::random(64);

            $findTransactionId->update([
                "status" => "PAID",
                "transaction_token_access" => $generateToken,
                "transaction_expired_at" => null,
            ]);

            session()->put("confirm_message", [
                "status" => "success",
                "title" => "Transaction success",
                "message" => "Please check your email for next instruction"
            ]);

            $getPricePeriod = $findTransactionId->period_type === "Monthly" ? $findTransactionId->PlanPurchase->price_per_month : $findTransactionId->PlanPurchase->price_per_year;

            $sendInvoicePaidToMail = new InvoicePaidMail([
                "id" => $findTransactionId->id,
                "full_name" => $findTransactionId->full_name,
                "payment_type" => $findTransactionId->payment_type,
                "address" => $findTransactionId->address,
                "total" => $findTransactionId->total,
                "price" => $getPricePeriod,
                "tax" => $findTransactionId->tax,
                "plan_name" => $findTransactionId->PlanPurchase->TenantSubscriptionPlan->name,
            ]);

            $sendTenantRegistration = new SendingTenantRegistration([
                "full_name" => $findTransactionId->full_name,
                "url" => route('transaction.tenant-registration', ['token' => Crypt::encrypt($generateToken)]),
            ]);

            Mail::to($findTransactionId->email)->queue($sendInvoicePaidToMail);
            Mail::to($findTransactionId->email)->later(now()->addSeconds(10), $sendTenantRegistration);

            session()->forget("last_history_transaction_id");

            return to_route('transaction.confirm-page');
        } catch (Exception $err) {
            Log::error($err->getMessage());
            return to_route('central.landingPage');
        }
    }
}

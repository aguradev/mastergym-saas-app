<?php

namespace App\Http\Controllers\MainPlatform\Transaction;

use App\Helpers\MidtransHelper;
use App\Http\Controllers\Controller;
use App\Models\CentralModel\TenantSubscriptionPlan;
use App\Models\CentralModel\TenantTransaction;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function RedirectToCheckout(TenantSubscriptionPlan $tenantSubscriptionPlan, $periodPurchase)
    {

        if (is_null($tenantSubscriptionPlan)) {
            return redirect()->back();
        }

        if ($periodPurchase != "Month" && $periodPurchase != "Yearly") {
            return redirect()->back();
        }

        $tenantSubscriptionPlan->load('TenantVersionLatest', 'TenantVersionLatest.PlanFeatures');

        session()->put('purchase_subscription_plan', $tenantSubscriptionPlan);
        session()->put('period_purchase', $periodPurchase);

        return to_route('transaction.checkout');
    }

    public function CheckoutPage()
    {
        if (!session()->has('purchase_subscription_plan')) {
            return to_route('central.landingPage');
        }

        $planOrder = session('purchase_subscription_plan');
        $periodPurchase = session('period_purchase');

        switch ($periodPurchase) {
            case "Month":
                $price = $planOrder->TenantVersionLatest->price_per_month;
                $totalPrice = (int) $price + ($price * (10 / 100));
                break;
            case "Yearly":
                $price = $planOrder->TenantVersionLatest->price_per_year;
                $totalPrice = (int) $price + ($price * (10 / 100));
                break;
            default:
                return to_route('central.landingPage');
                break;
        }


        return Inertia::render("landing_page/central_page/CheckoutTenant", compact('planOrder', 'totalPrice', 'price', 'periodPurchase'));
    }

    public function ProcessingOrderCheckout(Request $request)
    {

        $initialMidtrans = new MidtransHelper();
        $planOrder = session('purchase_subscription_plan');
        $periodPurchase = session('period_purchase');

        if (!session()->has('purchase_subscription_plan')) {
            return to_route('central.landingPage');
        }

        switch ($periodPurchase) {
            case "Month":
                $price = $planOrder->TenantVersionLatest->price_per_month;
                $totalPrice = (int) $price + ($price * (10 / 100));
                break;
            case "Yearly":
                $price = $planOrder->TenantVersionLatest->price_per_year;
                $totalPrice = (int) $price + ($price * (10 / 100));
                break;
            default:
                break;
        }

        $transactionsRequest = [
            "tenant_plan_id" => $planOrder->TenantVersionLatest->id,
            "full_name" => $request->full_name,
            "email" => $request->email,
            "phone_number" => $request->phone_number,
            "address" => $request->address,
            "tax" => $price * 10 / 100,
            "total" => $totalPrice,
            "status" => "PENDING"
        ];

        switch ($request->select_payment) {
            case "payment_gateway":
                $urlRedirectPaymentGateway = $initialMidtrans->createInvoiceTransaction([
                    "total" => $totalPrice,
                    "item_id" => time(),
                    "item_price" => $price,
                    "item_name" => $planOrder->name,
                    "full_name" => $request->full_name,
                    "email" => $request->email,
                    "phone_number" => $request->phone_number,
                    "address" => $request->address
                ]);

                if (is_null($urlRedirectPaymentGateway)) {
                    return redirect()->back()->with("message_error", "error: failed to processing payment gateway");
                }

                $transactionsRequest["payment_type"] = "payment_gateway";
                $transactionsRequest["payment_gateway_url"] = $urlRedirectPaymentGateway;

                DB::beginTransaction();

                try {
                    $createTransaction = TenantTransaction::create($transactionsRequest);
                } catch (Exception $err) {
                    DB::rollBack();
                    Log::error($err->getMessage());
                    return redirect()->back()->with("message_error", "error: failed to processing payment gateway");
                }

                DB::commit();

                session()->forget("purchase_subscription_plan");
                session()->forget("period_purchase");
                session()->put('last_history_transaction_id', $createTransaction->id);

                return Inertia::location($urlRedirectPaymentGateway);
            case "manual_transfer":
                DB::beginTransaction();
                $transactionsRequest["payment_type"] = "manual_transfer";

                try {
                    $createTransaction = TenantTransaction::create($transactionsRequest);
                } catch (Exception $err) {
                    DB::rollBack();
                    Log::error($err->getMessage());
                    return redirect()->back()->with("message_error", "error: failed to processing payment gateway");
                }

                DB::commit();

                session()->forget("purchase_subscription_plan");
                session()->forget("period_purchase");

                break;
            default:
                return redirect()->back()->with("message_error", "error: incorrect payment method");
        }
    }

    public function CancelTransaction()
    {
        session()->forget("purchase_subscription_plan");
        session()->forget("period_purchase");

        return to_route('central.landingPage');
    }
}

<?php

namespace App\Http\Controllers\MainPlatform\Transaction;

use App\Http\Controllers\Controller;
use App\Models\CentralModel\TenantSubscriptionPlan;
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
}

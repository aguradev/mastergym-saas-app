<?php

namespace App\Http\Controllers\MainPlatform\Transaction;

use App\Http\Controllers\Controller;
use App\Models\CentralModel\TenantSubscriptionPlan;
use Inertia\Inertia;

class CheckoutController extends Controller
{
    public function RedirectToCheckout(TenantSubscriptionPlan $tenantSubscriptionPlan)
    {

        if (is_null($tenantSubscriptionPlan)) {
            return redirect()->back();
        }


        session()->put('purchase_subscription_plan', $tenantSubscriptionPlan);
        return to_route('transaction.checkout');
    }

    public function CheckoutPage()
    {

        if (!session()->has('purchase_subscription_plan')) {
            return to_route('central.landingPage');
        }


        return Inertia::render("landing_page/central_page/CheckoutTenant");
    }
}

<?php

namespace App\Http\Controllers\MainPlatform\Dashboard\Tenant;

use App\Http\Controllers\Controller;
use App\Models\CentralModel\TenantSubscription;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SubscriptionController extends Controller
{
    public function TenantSubscriptionsPage(Request $request)
    {
        $subscriptionId = $request->query("subscription_id");
        $tenantSubscriptionModel = TenantSubscription::with([
            "Tenant.Domains",
            "Transaction.PlanPurchase",
            "Transaction.PlanPurchase.PlanFeatures",
            "Transaction.PlanPurchase.TenantSubscriptionPlan"
        ]);
        $userLogin = Auth::guard("central-web")->user();

        $tenantSubscriptionsLists = $tenantSubscriptionModel->get();
        $visibleModalDetail = Inertia::lazy(fn() => true);
        $getSubscriptionDataDetail = Inertia::lazy(fn() => $tenantSubscriptionModel->whereId($subscriptionId)->first());

        return Inertia::render('dashboard/central_page/subscription_tenant_page/Index', compact(
            'tenantSubscriptionsLists',
            'visibleModalDetail',
            'getSubscriptionDataDetail',
            'userLogin'
        ));
    }
}

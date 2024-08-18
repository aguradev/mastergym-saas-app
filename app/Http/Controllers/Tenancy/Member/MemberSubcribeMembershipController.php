<?php

namespace App\Http\Controllers\Tenancy\Member;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMembershipTenant;
use App\Models\TenancyModel\MembershipPlan;
use App\Models\TenancyModel\MemberTrainee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class MemberSubcribeMembershipController extends Controller
{
    public function MemberSubscriptionPage(Request $request)
    {
        $titlePage = tenant('name');
        $title = tenant("name") . " - " . "Member Subscription";
        $titleNav = "Member Subscription";
        $indexMenuActive = 1;
        $logoutUrl = "tenant-dashboard.logout";
        $userLogin = Auth::guard("tenant-web")->user();

        $userLogin->load("User", "User.MemberTrainees", "User.MemberTrainees.MembershipPlan");

        $membershipSubs = $userLogin->User;

        $permissions = [
            'access_dashboard_menu_tenant' => $userLogin->User->hasPermissionTo('access_dashboard_menu_tenant'),
            'access_dashboard_menu_member' => $userLogin->User->hasPermissionTo('access_dashboard_menu_member')
        ];

        $modalTraineeDetail = Inertia::lazy(fn() => true);
        $memberTrainessDetail = Inertia::lazy(function () use ($request) {
            $trainessId = $request->query("id");

            return MemberTrainee::with(["User", "MembershipPlan", "User.TenantCredential"])->where("id", $trainessId)->first();
        });

        return Inertia::render('dashboard/tenant_page/member_dashboard/member_subscription_page/Index', compact('titlePage', 'title', 'titleNav', 'indexMenuActive', 'logoutUrl', 'userLogin', 'permissions', 'membershipSubs', 'modalTraineeDetail', 'memberTrainessDetail'));
    }

    public function MemberCheckoutSubmmited(Request $request)
    {
        $validated = $request->validate([
            "membershipPlanId" => "required",
            "imageInvoiceUpload" => "image|max:1024",
            "fitnessGoal" => "required|min:10"
        ]);

        DB::beginTransaction();

        try {
            // get membership data and user
            $membershipData = MembershipPlan::where("id", $validated['membershipPlanId'])->first();

            $user = Auth::guard("tenant-web")->user();
            $getTaxTransaction = 20 / 100 * $membershipData->amount;
            $getTotalTransaction = $getTaxTransaction + $membershipData->amount;

            // setup form request
            $requestDataTransactions = [
                "invoice_id" => time(),
                "membership_id" => $membershipData->id,
                "fitness_goal" => $validated['fitnessGoal'],
                "tax" => $getTaxTransaction,
                "total" => $getTotalTransaction,
                "transaction_status" => "PENDING",
                "membership_status" => "INACTIVE",
                "created_at" => now(),
            ];

            $full_name =  $user->User->first_name . " " . $user->User->last_name;

            // upload invoice
            $path_image_profile = "public/tenant-" . tenant("id") . "/assets/images/member-invoice";
            $invoiceFile = $request->file("imageInvoiceUpload");
            $invoiceFileName = time() . "-" . str("invoice " . $full_name)->slug() . "." . $invoiceFile->getClientOriginalExtension();

            $invoiceFile->storeAs($path_image_profile, $invoiceFileName);

            $requestDataTransactions['file_invoice_upload'] = $invoiceFileName;
            // create data for table fitness trainess
            $user->User->MemberTrainees()->create($requestDataTransactions);

            // send email to member
            Mail::to($user->email)->queue(new InvoiceMembershipTenant([
                "invoice_id" => $requestDataTransactions['invoice_id'],
                "full_name" => $full_name,
                "transaction_date" => Carbon::now()->format("Y,m d H:i:s"),
                "membership_plan" => $membershipData,
                "tax" => $getTaxTransaction,
                "total" => $getTotalTransaction,
            ]));

            DB::commit();
        } catch (\Throwable $err) {
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Registered failed");
        }

        return redirect()->back()->with("message_success", "Registered success");
    }
}

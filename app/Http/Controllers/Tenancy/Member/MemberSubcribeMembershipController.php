<?php

namespace App\Http\Controllers\Tenancy\Member;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\MembershipPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MemberSubcribeMembershipController extends Controller
{
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
                "membership_id" => $membershipData->id,
                "fitness_goal" => $validated['fitnessGoal'],
                "tax" => $getTaxTransaction,
                "total" => $getTotalTransaction,
                "transaction_status" => "PENDING",
                "status" => "INACTIVE",
                "created_at" => now(),
            ];

            // upload invoice
            $path_image_profile = "public/tenant-" . tenant("id") . "/assets/images/member-invoice";
            $invoiceFile = $request->file("imageInvoiceUpload");
            $invoiceFileName = time() . "-" . str("invoice " . $user->User->first_name . " " . $user->User->last_name)->slug() . "." . $invoiceFile->getClientOriginalExtension();

            $invoiceFile->storeAs($path_image_profile, $invoiceFileName);

            $requestDataTransactions['file_invoice_upload'] = $invoiceFileName;
            // create data for table fitness trainess
            $user->User->MemberTrainees()->create($requestDataTransactions);

            // send email to member
            DB::commit();
        } catch (\Throwable $err) {
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Registered failed");
        }

        return redirect()->back()->with("message_success", "Registered success");
    }
}

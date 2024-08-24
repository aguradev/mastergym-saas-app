<?php

namespace App\Http\Controllers\Tenancy\Dashboard\Trainess;

use App\Http\Controllers\Controller;
use App\Mail\MailMembershipNotification;
use App\Models\TenancyModel\MemberTrainee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class UserTrainessController extends Controller
{
    public function TrainessListPage(Request $request)
    {
        $titlePage = tenant('name');
        $title = tenant("name") . " - " . "Trainees";
        $titleNav = "Trainess Management";
        $indexMenuActive = 3;
        $logoutUrl = "tenant-dashboard.logout";
        $userLogin = Auth::guard("tenant-web")->user();

        $permissions = [
            'access_dashboard_menu_tenant' => $userLogin->hasPermissionTo('access_dashboard_menu_tenant'),
            'access_dashboard_menu_member' => $userLogin->hasPermissionTo('access_dashboard_menu_member')
        ];

        $userTrainess = MemberTrainee::with(["User", "MembershipPlan"])->paginate(5);
        $modalTrainessDetail = Inertia::lazy(fn() => true);
        $modalTrainessEdit = Inertia::lazy(fn() => true);
        $memberTrainessDetail = Inertia::lazy(function () use ($request) {
            $trainessId = $request->query("id");

            return MemberTrainee::with(["User", "MembershipPlan"])->where("id", $trainessId)->first();
        });

        return Inertia::render('dashboard/tenant_page/trainess_page/TrainessManagement', compact(
            'titlePage',
            'title',
            'titleNav',
            'indexMenuActive',
            'logoutUrl',
            'userLogin',
            'permissions',
            'userTrainess',
            'memberTrainessDetail',
            'modalTrainessDetail',
            'modalTrainessEdit'
        ));
    }

    public function UpdateMembershipTrainessStatus(Request $request, MemberTrainee $memberTrainee)
    {
        $memberTrainee->load("User", "MembershipPlan");

        $validated = $request->validate([
            "transaction_status" => "required",
            "membership_status" => ["required", function ($attribute, $value, $fail) use ($request) {
                if ($value == 'ACTIVE' && $request->transaction_status != 'PAID') {
                    $fail('The membership status cannot be ACTIVE unless the transaction status is PAID.');
                }
            }]
        ]);

        $transactionStatusBefore = $memberTrainee->transaction_status;
        $membershipStatusBefore = $memberTrainee->membership_status;

        DB::beginTransaction();

        try {
            $requestValidatedForm = [
                "transaction_status" => $validated['transaction_status'],
                "membership_status" => $validated['membership_status'],
                "updated_at" => now()
            ];

            if ($requestValidatedForm['membership_status'] == "ACTIVE") {
                $checkMembershipTrainessActive = MemberTrainee::where("user_id", $memberTrainee->User->id)
                    ->where("transaction_status", "PAID")
                    ->where("membership_status", "ACTIVE")
                    ->first();

                if ($checkMembershipTrainessActive) {
                    $checkMembershipTrainessActive->update([
                        "membership_status" => "INACTIVE"
                    ]);
                }
            }

            if (is_null($memberTrainee->updated_at)) {
                if (is_null($memberTrainee->membership_start_date) && is_null($memberTrainee->membership_expired_date)) {
                    $dateNow = now();
                    $requestValidatedForm['membership_start_date'] = now();
                    switch ($memberTrainee->MembershipPlan->period_type) {
                        case "Monthly":
                            $requestValidatedForm['membership_expired_date'] = $dateNow->addMonth();
                            break;
                        case "Half Yearly":
                            $requestValidatedForm['membership_expired_date'] = $dateNow->addMonths(6);
                            break;
                        case "Yearly":
                            $requestValidatedForm['membership_expired_date'] = $dateNow->addYear();
                            break;
                        default:
                            break;
                    }
                }
            }

            $updateMemberTrainee = $memberTrainee->update($requestValidatedForm);

            if ($updateMemberTrainee) {
                if ($transactionStatusBefore == "PENDING" && $memberTrainee->transaction_status == "PAID") {
                    // send email to user a membership is activated
                    Mail::to($memberTrainee->User->email)->queue(new MailMembershipNotification($memberTrainee->User->full_name, "MEMBERSHIP_ACTIVE"));
                }

                if ($membershipStatusBefore == "ACTIVE" && $memberTrainee->membership_status == "INACTIVE") {
                    // send email to user a membership is deactivated
                    Mail::to($memberTrainee->User->email)->queue(new MailMembershipNotification($memberTrainee->User->full_name, "MEMBERSHIP_INACTIVE"));
                }

                DB::commit();
            }
        } catch (\Throwable $err) {
            DB::rollBack();
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Failed update status member trainess");
        }

        return redirect()->back()->with("message_success", "Success update status member trainess");
    }
}

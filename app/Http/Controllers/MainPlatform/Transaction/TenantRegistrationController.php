<?php

namespace App\Http\Controllers\MainPlatform\Transaction;

use App\CentralServices\Tenant\Services\Interfaces\TenantServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CentralRequest\TenantTransactionRegistration;
use App\Models\Auth\TenantCredential;
use App\Models\CentralModel\TenantSubscription;
use App\Models\CentralModel\TenantTransaction;
use App\Models\Gym\Tenant;
use App\Notifications\WelcomeNewTenant;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class TenantRegistrationController extends Controller
{
    private $centralTenantServices;

    public function __construct(TenantServiceInterface $centralTenantService)
    {
        $this->centralTenantServices = $centralTenantService;
    }

    public function RegistrationPage(Request $request)
    {
        $token = $request->query("token");

        return Inertia::render("transactions/tenant_register", compact('token'));
    }

    public function TenantRegistrationSubmit(TenantTransactionRegistration $request)
    {
        $tokens = $request->query("token");

        try {
            $decryptionToken = Crypt::decrypt($tokens);

            $findTransaction = TenantTransaction::where("transaction_token_access", $decryptionToken)
                ->first();

            if (!$findTransaction) {
                return redirect()->back()->with("message_error", "Failed create tenant");
            }
        } catch (DecryptException $err) {
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Failed create tenant");
        }

        $registrationServiceHandling = $this->centralTenantServices->TenantRegistrationHandler($request->validated());

        if (!$registrationServiceHandling) {
            return redirect()->back()->with("message_error", "Failed create tenant");
        }

        DB::beginTransaction();

        try {
            $createSubscription = TenantSubscription::create([
                "tenant_id" => $registrationServiceHandling->id,
                "invoice_transaction_id" => $findTransaction->id,
                "start_date" => now(),
                "due_date" => $findTransaction->period_type === "Monthly" ? now()->addMonth() : now()->addYear()
            ]);

            if ($createSubscription) {
                $findTransaction->transaction_token_access = null;
                $findTransaction->save();
            }

            DB::commit();
        } catch (Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());
            return redirect()->back()->with('message_error', 'failed create tenant');
        }

        return Inertia::render('transactions/confirm', [
            "status" => "success",
            "title" => "Success",
            "message" => "Your tenant is registered! Check your email for more information"
        ]);
    }
}

<?php

namespace App\Http\Controllers\MainPlatform\Transaction;

use App\CentralServices\Tenant\Services\Interfaces\TenantServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CentralRequest\TenantTransactionRegistration;
use App\Models\Auth\TenantCredential;
use App\Models\CentralModel\TenantSubscription;
use App\Models\CentralModel\TenantTransaction;
use App\Models\Gym\Tenant;
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

    public function RegistrationPage()
    {
        return Inertia::render("transactions/tenant_register");
    }

    public function TenantRegistrationSubmit(TenantTransactionRegistration $request)
    {
        $tokens = $request->query("token");

        $findTransaction = TenantTransaction::where("transaction_token_access", $tokens)->first();

        if (!$findTransaction) {
            return redirect()->back()->with("message_error", "Failed create tenant");
        }

        $registrationServiceHandling = $this->centralTenantServices->TenantRegistrationHandler($request->validated());

        if (!$registrationServiceHandling) {
            return redirect()->back()->with("message_error", "Failed create tenant");
        }

        try {
            $dateNow = now();

            TenantSubscription::create([
                "tenant_id" => $registrationServiceHandling->id,
                "invoice_transaction_id" => $findTransaction->id,
                "start_date" => $dateNow,
                "due_date" => $findTransaction->period_type === "Monthly" ? $dateNow->addMonth() : $dateNow->addYear()
            ]);
        } catch (Exception $err) {
            Log::error($err);
        }


        return redirect()->back()->with('message_success', 'Tenant Registered!');
    }
}

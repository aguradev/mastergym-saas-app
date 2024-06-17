<?php

namespace App\Http\Controllers\MainPlatform\Transaction;

use App\Http\Controllers\Controller;
use App\Http\Requests\CentralRequest\TenantTransactionRegistration;
use App\Models\Auth\TenantCredential;
use App\Models\Gym\Tenant;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class TenantRegistrationController extends Controller
{
    public function RegistrationPage()
    {
        return Inertia::render("transactions/tenant_register");
    }

    public function TenantRegistrationSubmit(TenantTransactionRegistration $request)
    {
        try {
            $tenantRegistrationRequest = [
                "name" => $request->gym_title,
                "email" => $request->email,
                "address" => $request->address,
            ];

            $domainRegistrationRequest = [
                "domain" => $request->domain . ".localhost",
            ];

            $tenantFirstUserRegistration = [
                "email" => $request->email,
                "password" => $request->password
            ];

            $isTenantCreated = Tenant::create($tenantRegistrationRequest);

            if (!$isTenantCreated) {
                throw new Exception("Error when create tenant");
            }

            $isTenantDomainCreated = $isTenantCreated->domains()->create($domainRegistrationRequest);

            if (!$isTenantDomainCreated) {
                throw new Exception("Error when create tenant domain");
            }
            $isTenantCreated->run(function () use ($tenantFirstUserRegistration) {
                $createCredential = TenantCredential::create($tenantFirstUserRegistration);

                if (!$createCredential) {
                    throw new Exception("error when failed create credential tenant");
                }
            });

            return redirect()->back()->with('message_success', 'Tenant Registered!');
        } catch (Exception $err) {
            return redirect()->back()->with("message_error", "Failed create tenant");
        }
    }
}

<?php

namespace App\Http\Controllers\MainPlatform\Transaction;

use App\CentralServices\Tenant\Services\Interfaces\TenantServiceInterface;
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
        $registrationServiceHandling = $this->centralTenantServices->TenantRegistrationHandler($request->validated());

        if (!$registrationServiceHandling) {
            return redirect()->back()->with("message_error", "Failed create tenant");
        }
        return redirect()->back()->with('message_success', 'Tenant Registered!');
    }
}

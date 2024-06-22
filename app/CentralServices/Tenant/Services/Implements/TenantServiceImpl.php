<?php

namespace app\CentralServices\Tenant\Services\Implements;

use app\CentralServices\Tenant\Repositories\Interfaces\TenantRepoInterface;
use app\CentralServices\Tenant\Services\Interfaces\TenantServiceInterface;
use Illuminate\Support\Facades\Log;

class TenantServiceImpl implements TenantServiceInterface
{
    private $tenantRepo;

    public function __construct(TenantRepoInterface $tenant)
    {
        $this->tenantRepo = $tenant;
    }

    public function TenantRegistrationHandler(array $request)
    {
        $tenantRegistration = [
            "name" => $request["gym_title"],
            "email" => $request["email"],
            "address" => $request["address"]
        ];

        $processRegistration = $this->tenantRepo->CreateTenantDomainRegistration($tenantRegistration, $request["domain"]);

        if (!$processRegistration) {
            return false;
        }

        return true;
    }
}

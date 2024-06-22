<?php

namespace App\CentralServices\Tenant\Services\Implements;

use App\CentralServices\Tenant\Repositories\Interfaces\TenantRepoInterface;
use App\CentralServices\Tenant\Services\Interfaces\TenantServiceInterface;

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

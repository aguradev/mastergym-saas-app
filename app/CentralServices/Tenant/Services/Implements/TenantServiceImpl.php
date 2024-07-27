<?php

namespace App\CentralServices\Tenant\Services\Implements;

use App\CentralServices\Tenant\Repositories\Interfaces\TenantRepoInterface;
use App\CentralServices\Tenant\Services\Interfaces\TenantServiceInterface;
use App\Notifications\WelcomeNewTenant;
use App\TenancyServices\User\Repositories\Interfaces\TenantUserRepoInterface;

class TenantServiceImpl implements TenantServiceInterface
{
    private $tenantRepo, $tenantUser;

    public function __construct(TenantRepoInterface $tenant, TenantUserRepoInterface $user)
    {
        $this->tenantRepo = $tenant;
        $this->tenantUser = $user;
    }

    public function TenantRegistrationHandler(array $request)
    {
        $tenantRegistration = [
            "name" => $request["gym_title"],
            "email" => $request["gym_email"],
            "address" => $request["address"]
        ];


        $processRegistration = $this->tenantRepo->CreateTenantDomainRegistration($tenantRegistration, $request["domain"]);


        if (!$processRegistration) {
            return false;
        }

        $processRegistration->notify(new WelcomeNewTenant($processRegistration, $processRegistration->domains->first()->domain));

        $userRegistrations = [
            "first_name" => $request["first_name"],
            "last_name" => $request["last_name"],
            "email" => $request["user_email"],
            "password" => $request["password"],
        ];

        $createdUserTenant = $this->tenantUser->CreateUserCredentialProfile($processRegistration->id, $userRegistrations);

        if (!$createdUserTenant) {
            return false;
        }

        return $processRegistration;
    }
}

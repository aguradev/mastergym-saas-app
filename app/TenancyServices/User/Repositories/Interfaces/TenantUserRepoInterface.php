<?php

namespace App\TenancyServices\User\Repositories\Interfaces;

interface TenantUserRepoInterface
{
    public function CreateUserCredentialProfile(string $tenantId, array $request);
}

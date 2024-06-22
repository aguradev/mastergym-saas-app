<?php

namespace app\TenancyService\User\Repositories\Interfaces;

interface TenantUserRepoInterface
{
    public function CreateUserCredentialProfile(string $tenantId, array $request);
}

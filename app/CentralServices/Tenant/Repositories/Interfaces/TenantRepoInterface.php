<?php

namespace app\CentralServices\Tenant\Repositories\Interfaces;

interface TenantRepoInterface
{
    public function CreateTenantDomainRegistration(array $requestTenantRegis, array $domain);
}

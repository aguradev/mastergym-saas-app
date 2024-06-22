<?php

namespace app\CentralServices\Tenant\Repositories\Implements;

use app\CentralServices\Tenant\Repositories\Interfaces\TenantInterface;
use app\CentralServices\Tenant\Repositories\Interfaces\TenantRepoInterface;
use App\Models\Gym\Tenant;
use Exception;
use Illuminate\Support\Facades\Log;

class TenantRepoImpl implements TenantRepoInterface
{
    private $tenantModel;

    public function __construct(Tenant $tenant)
    {
        $this->tenantModel = $tenant;
    }
    public function CreateTenantDomainRegistration(array $requestTenantRegis, array $domain)
    {
        try {
            $isTenantCreated = $this->tenantModel->create($requestTenantRegis);

            $isTenantCreated->domains()->create([
                "domain" => $domain . ".localhost"
            ]);
        } catch (\Exception $err) {
            Log::debug($err->getMessage());
            return false;
        }

        return true;
    }
}

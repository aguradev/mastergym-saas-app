<?php

namespace App\CentralServices\Tenant\Repositories\Implements;

use App\CentralServices\Tenant\Repositories\Interfaces\TenantRepoInterface;
use App\Models\Gym\Tenant;
use App\Notifications\WelcomeNewTenant;
use Exception;
use Illuminate\Support\Facades\Log;

class TenantRepoImpl implements TenantRepoInterface
{
    private $tenantModel;

    public function __construct(Tenant $tenant)
    {
        $this->tenantModel = $tenant;
    }
    public function CreateTenantDomainRegistration(array $requestTenantRegis, string $domain)
    {
        try {
            $isTenantCreated = $this->tenantModel->create($requestTenantRegis);

            $createDomain = $isTenantCreated->domains()->create([
                "domain" => $domain . ".localhost"
            ]);

            if (!$createDomain) {
                throw new Exception("Failed create domain");
            }

            $isTenantCreated->notify(new WelcomeNewTenant($isTenantCreated, $createDomain->domain));
        } catch (\Exception $err) {
            Log::error($err->getMessage());
            return false;
        }

        return $isTenantCreated;
    }
}

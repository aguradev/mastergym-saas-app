<?php

use App\Models\Auth\TenantCredential;
use App\Models\Gym\Tenant;
use app\TenancyService\User\Repositories\Implements;
use app\TenancyService\User\Repositories\Interfaces\TenantUserRepoInterface;
use Illuminate\Support\Facades\Log;

class TenantUserRepoImpl implements TenantUserRepoInterface
{
    private $tenantModel;

    public function __construct(Tenant $tenant)
    {
        $this->tenantModel = $tenant;
    }

    public function CreateUserCredentialProfile(string $tenantId, array $request)
    {
        try {
            $findTenant = $this->tenantModel->whereId($tenantId)->first();

            if (is_null($findTenant)) {
                throw new Exception("tenant not found");
            }

            $findTenant->run(function () use ($request) {
                TenantCredential::create($request);
            });
        } catch (\Exception $err) {
            Log::debug($err->getMessage());
            return false;
        }

        return true;
    }
}

<?php

namespace App\TenancyServices\User\Repositories\Implements;

use App\Models\Gym\Tenant;
use App\Models\TenancyModel\User;
use App\TenancyServices\User\Repositories\Interfaces\TenantUserRepoInterface;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
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
                throw new ModelNotFoundException("Tenant with ID " . $tenantId . " not found");
            }

            $findTenant->run(function () use ($request) {
                DB::beginTransaction();

                $createCredential = User::create([
                    "username" => strtolower($request["first_name"] . "_" . $request["last_name"]),
                    "email" => $request["email"],
                    "password" => $request["password"],
                    "first_name" => $request["first_name"],
                    "last_name" => $request["last_name"],
                    "bio" => "this is bio..."
                ]);

                if (!$createCredential) {
                    DB::rollBack();
                    throw new Exception("failed create credential tenant user");
                }


                $createCredential->assignRole("Super admin");

                DB::commit();
            });
        } catch (\Exception $err) {
            $message = $err->getMessage();

            Log::error($message);
            return false;
        }

        return true;
    }
}

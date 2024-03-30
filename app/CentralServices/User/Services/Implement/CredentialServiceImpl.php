<?php

namespace App\CentralServices\User\Services\Implement;

use App\CentralServices\User\Services\Interfaces\CredentialInterface;
use App\CentralServices\User\Repositories\Interfaces\CredentialInterface as CredentialRepo;

class CredentialServiceImpl implements CredentialInterface
{
    private $credential;

    function __construct(CredentialRepo $credentialRepo)
    {
        $this->credential = $credentialRepo;
    }
    public function getUserAuth()
    {
        return $this->credential->userAuth();
    }
}

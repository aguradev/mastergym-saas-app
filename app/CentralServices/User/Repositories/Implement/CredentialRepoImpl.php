<?php

namespace App\CentralServices\User\Repositories\Implement;

use App\CentralServices\User\Repositories\Interfaces\CredentialInterface;
use Illuminate\Support\Facades\Auth;

class CredentialRepoImpl implements CredentialInterface
{
    public function userAuth()
    {
        return Auth::guard('central-web')->user();
    }
}

<?php

namespace App\Http\Controllers\Tenancy\Dashboard\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthenticationController extends Controller
{
    public function DashboardAuthenticationPage()
    {
        $tenantName = tenant('name');

        return Inertia::render('auth/tenant_page/Auth_page', compact('tenantName'));
    }
}

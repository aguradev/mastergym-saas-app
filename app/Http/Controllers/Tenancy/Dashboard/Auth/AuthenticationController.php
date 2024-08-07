<?php

namespace App\Http\Controllers\Tenancy\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\TenantCredential;
use App\Models\TenancyModel\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthenticationController extends Controller
{
    public function DashboardAuthenticationPage()
    {
        $tenantName = tenant('name');

        return Inertia::render('auth/tenant_page/Auth_page', compact('tenantName'));
    }

    public function Authenticable(Request $request)
    {
        $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        $attemptAuthentication = Auth::guard('tenant-web')->attempt([
            "email" => $request->email,
            "password" => $request->password
        ]);

        if ($attemptAuthentication) {
            $request->session()->regenerate();
            return to_route("tenant-dashboard.overview-page");
        }

        return redirect()->back()->with('message_error', 'Credential is incorrect');
    }
}

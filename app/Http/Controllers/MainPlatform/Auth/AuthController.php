<?php

namespace App\Http\Controllers\MainPlatform\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function AuthPage()
    {
        return Inertia::render("views/auth/central_page/Auth_page");
    }

    public function Authenticable(Request $request)
    {
        $request->validate([
            "username" => "required|email",
            "password" => "required"
        ]);

        $formRequest = $request->all();

        $authenticationAttemp = Auth::guard("central-web")->attempt([
            "email" => $formRequest["username"],
            "password" => $formRequest["password"]
        ]);

        if ($authenticationAttemp) {
            $request->session()->regenerate();

            return redirect()->route("main.dashboard");
        }

        return redirect()->back()->withErrors([
            "message" => "Credentials is incorrect"
        ]);
    }

    public function Logout(Request $request)
    {
        Auth::guard("central-web")->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return to_route("login");
    }
}

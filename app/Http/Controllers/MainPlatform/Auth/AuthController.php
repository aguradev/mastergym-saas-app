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
            "message" => "credentials is incorrect"
        ]);
    }
}

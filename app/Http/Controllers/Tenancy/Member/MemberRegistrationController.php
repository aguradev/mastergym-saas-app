<?php

namespace App\Http\Controllers\Tenancy\Member;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMemberTenantMail;
use App\Models\TenancyModel\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class MemberRegistrationController extends Controller
{
    public function MemberRegistrationPage()
    {
        return Inertia::render('auth/tenant_page/Register');
    }

    public function RegistrationSubmit(Request $request)
    {
        $validated = $request->validate([
            "first_name" => "required",
            "last_name" => "required",
            "username" => "required",
            "phone_number" => "required",
            "email" => "required|email|unique:tenant_users,email",
            "password" => ["required", "confirmed", Password::min(8)],
            "password_confirmation" => "required"
        ]);

        $userCredentialData = [
            "username" => $validated["username"],
            "first_name" => $validated["first_name"],
            "last_name" => $validated["last_name"],
            "password" => Hash::make($validated['password']),
            "email" => $validated["email"],
            "phone_number" => $validated["phone_number"]
        ];

        DB::beginTransaction();

        try {
            $createCredential = User::create([
                "first_name" => $userCredentialData["first_name"],
                "last_name" => $userCredentialData["last_name"],
                "phone_number" => $userCredentialData["phone_number"],
                "username" => $userCredentialData["username"],
                "email" => $userCredentialData["email"],
                "password" => $userCredentialData['password'],
            ]);

            $createCredential->assignRole("Member");

            DB::commit();

            Mail::to($createCredential['email'])->queue(new WelcomeMemberTenantMail($validated['username'], $validated['email']));

            Auth::guard("tenant-web")->login($createCredential);

            return to_route("tenant-dashboard.overview-page");
        } catch (\Throwable $err) {
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Failed registration");
        }
    }
}

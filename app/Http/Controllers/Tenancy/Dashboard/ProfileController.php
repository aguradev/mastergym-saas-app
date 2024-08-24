<?php

namespace App\Http\Controllers\Tenancy\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\TenancyModel\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function ProfilePage()
    {
        $userLogin = Auth::guard("tenant-web")->user();

        $titlePage = tenant('name');
        $title = tenant("name") . " - " . "Profile";
        $logoutUrl = "tenant-dashboard.logout";
        $titleNav = "Profile";
        $indexMenuActive = 2;

        return Inertia::render(
            "dashboard/tenant_page/profile_page/Index",
            compact('titlePage', 'title', 'titleNav', 'indexMenuActive', 'userLogin', 'logoutUrl')
        );
    }

    public function ProfileUpdate(Request $request, User $user)
    {
        $validated = $request->validate([
            "profile" => ["max:1024"],
            "username" => ["required", "unique:tenant_users,username," . $user->id],
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|unique:tenant_users,email," . $user->id,
            "phone_number" => "required|numeric",
            "password" => "confirmed"
        ]);

        $userCredentialData = [
            "username" => $validated["username"],
            "first_name" => $validated["first_name"],
            "last_name" => $validated["last_name"],
            "password" => $validated["password"] ? Hash::make($validated["password"]) : $user->password,
            "email" => $validated["email"],
            "phone_number" => $validated["phone_number"]
        ];

        if ($request->hasFile("profile")) {
            $profileImg = $validated['profile'];
            $profile_image_path = "tenant-" . tenant("id") . "/assets/images/profile/";

            $imageFormat = $profileImg->extension();

            $image_name = time() . "-" . str()->slug($validated['username']) . "." . $imageFormat;

            if ($user->profile_url != "profile.png") {
                $findImageExists = Storage::disk('public')->exists($profile_image_path . $user->profile_url);

                if ($findImageExists) {
                    Storage::disk('public')->delete($profile_image_path . $user->profile_url);
                }
            }
            $profileImg->storeAs("public/" . $profile_image_path, $image_name);

            $userCredentialData['profile_url'] = $image_name;
        } else {
            $userCredentialData['profile_url'] = $user->profile_url;
        }

        DB::beginTransaction();

        try {
            $user->update([
                "username" => $userCredentialData["username"],
                "email" => $userCredentialData["email"],
                "password" => $userCredentialData['password'],
                "first_name" => $userCredentialData["first_name"],
                "last_name" => $userCredentialData["last_name"],
                "phone_number" => $userCredentialData["phone_number"],
                "profile_url" => $userCredentialData['profile_url']
            ]);

            DB::commit();
        } catch (\Throwable $err) {
            DB::rollBack();
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Failed update user profile");
        }

        return redirect()->back()->with("message_success", "Success update user profile");
    }
}

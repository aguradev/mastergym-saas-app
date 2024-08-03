<?php

namespace App\Http\Controllers\Tenancy\Dashboard\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\TenantRequest\UserCredentialRequest;
use App\Models\Auth\TenantCredential;
use App\Models\Authorization\Role;
use App\Models\TenancyModel\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Database\Seeders\tenants\CredentialSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function UsersManagementPage()
    {
        $titlePage = tenant('name');
        $title = tenant("name") . " - " . "users";
        $titleNav = "User Management";
        $indexMenuActive = 1;

        $usersData = User::with(['TenantCredential', 'roles'])->paginate(5);
        $rolesLists = Inertia::lazy(fn () => Role::where("guard_name", "tenant-web")->get());

        $modalUserCreate = Inertia::lazy(fn () => true);
        $modalUserEdit = Inertia::lazy(fn () => true);

        Debugbar::debug($usersData);

        return Inertia::render(
            'dashboard/tenant_page/user_management/users/Index',
            compact('titlePage', 'title', 'indexMenuActive', 'titleNav', 'usersData', 'modalUserCreate', 'rolesLists')
        );
    }

    public function RolesManagementPage()
    {
        $title = tenant("name") . " - " . "roles";
        $titleNav = "Roles Management";
        $indexMenuActive = 1;

        $rolesDatas = Role::where('guard_name', 'tenant-web')->paginate(5);
        $superAdminCount = User::with('roles')->get()->filter(
            fn ($user) => $user->roles->where('name', 'Super admin')->toArray()
        )->count();

        return Inertia::render(
            'dashboard/tenant_page/user_management/roles/Index',
            compact('title', 'indexMenuActive', 'titleNav', 'rolesDatas', 'superAdminCount')
        );
    }

    public function CreateUser(UserCredentialRequest $request)
    {
        $requestValidated = $request->validated();
        $path_image_profile = "public/tenancy/" . tenant("id") . "/assets/images/profile";

        $userCredentialData = [
            "username" => $requestValidated["username"],
            "role" => $requestValidated["role"],
            "first_name" => $requestValidated["first_name"],
            "last_name" => $requestValidated["last_name"],
            "password" => $requestValidated["password"],
            "email" => $requestValidated["email"],
            "phone_number" => $requestValidated["phone_number"]
        ];

        try {
            DB::beginTransaction();

            if ($request->hasFile("profileImg")) {
                $profileImg = $requestValidated["profileImg"];
                $imageFormat = $profileImg->extension();

                $image_name = time() . "-" . str()->slug($requestValidated['username']) . "." . $imageFormat;

                $profileImg->storeAs($path_image_profile, $image_name);
            }

            $credential = TenantCredential::create([
                "username" => $userCredentialData["username"],
                "email" => $userCredentialData["email"],
                "password" => Hash::make($userCredentialData["password"]),
            ]);

            $credential->User()->create([
                "first_name" => $userCredentialData["first_name"],
                "last_name" => $userCredentialData["last_name"],
                "phone_number" => $userCredentialData["phone_number"],
                "profile_url" => $image_name
            ]);

            $credential->user->assignRole($userCredentialData['role']);

            DB::commit();
        } catch (\Throwable $err) {
            Log::error($err->getMessage());
            DB::rollBack();
            return redirect()->back()->with("message_error", "Failed create new user");
        }

        return redirect()->back()->with("message_success", "Success create new user");
    }
}

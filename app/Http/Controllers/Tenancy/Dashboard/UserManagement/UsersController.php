<?php

namespace App\Http\Controllers\Tenancy\Dashboard\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\TenantRequest\UserCredentialRequest;
use App\Models\Auth\TenantCredential;
use App\Models\Authorization\Permission;
use App\Models\Authorization\Role;
use App\Models\TenancyModel\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Database\Seeders\tenants\CredentialSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function UsersManagementPage(Request $request)
    {
        $titlePage = tenant('name');
        $title = tenant("name") . " - " . "users";
        $titleNav = "User Management";
        $indexMenuActive = 1;
        $logoutUrl = "tenant-dashboard.logout";
        $userLogin = Auth::guard("tenant-web")->user();

        $usersData = User::with(['TenantCredential'])->withWhereHas('roles', function ($query) use ($userLogin) {
            if ($userLogin->User->hasRole('Admin')) {
                return $query->where("name", "Member");
            }
        })->paginate(5);

        $rolesLists = Inertia::lazy(function () use ($userLogin) {
            $roleTenantWeb = Role::where("guard_name", "tenant-web");

            if ($userLogin->User->hasRole('Admin')) {
                return $roleTenantWeb->where("name", "Member")->get();
            }

            return $roleTenantWeb->get();
        });

        $modalUserCreate = Inertia::lazy(fn() => true);
        $modalUserEdit = Inertia::lazy(fn() => true);
        $getUserDetail = Inertia::lazy(function () use ($request) {
            $queryId = $request->query("id");
            return User::with(['TenantCredential', 'roles'])->whereId($queryId)->first();
        });

        $permissions = [
            'access_dashboard_menu_tenant' => $userLogin->User->hasPermissionTo('access_dashboard_menu_tenant'),
            'access_dashboard_menu_member' => $userLogin->User->hasPermissionTo('access_dashboard_menu_member')
        ];

        Debugbar::debug($usersData);

        return Inertia::render(
            'dashboard/tenant_page/user_management/users/Index',
            compact('titlePage', 'title', 'indexMenuActive', 'titleNav', 'usersData', 'modalUserCreate', 'rolesLists', 'getUserDetail', 'modalUserEdit', 'logoutUrl', 'userLogin', 'permissions')
        );
    }

    public function RolesManagementPage(Request $request)
    {
        $title = tenant("name") . " - " . "roles";
        $titleNav = "Roles Management";
        $indexMenuActive = 1;
        $logoutUrl = "tenant-dashboard.logout";
        $userLogin = Auth::guard("tenant-web")->user();

        $rolesDatas = Role::where('guard_name', 'tenant-web')->withCount('permissions')->paginate(5);
        $modalCreate = Inertia::lazy(fn() => true);
        $getRoles = User::with('roles')->get();

        $superAdminCount = $getRoles->filter(
            fn($user) => $user->roles->where('name', 'Super admin')->toArray()
        )->count();

        $staffCount = $getRoles->filter(
            fn($user) => $user->roles->where('name', 'Admin')->toArray()
        )->count();

        $memberCount = $getRoles->filter(
            fn($user) => $user->roles->where('name', 'Member')->toArray()
        )->count();

        $modalAddPermission = Inertia::lazy(fn() => true);
        $rolesDetail = Inertia::lazy(function () use ($request) {
            $getIdParams = $request->query("id");

            return Role::with('permissions')->where("id", $getIdParams)->where("guard_name", "tenant-web")->first();
        });

        $permissionLists = Inertia::lazy(function () {
            return Permission::where("guard_name", "tenant-web")->get();
        });

        $permissions = [
            'access_dashboard_menu_tenant' => $userLogin->User->hasPermissionTo('access_dashboard_menu_tenant'),
            'access_dashboard_menu_member' => $userLogin->User->hasPermissionTo('access_dashboard_menu_member')
        ];

        return Inertia::render(
            'dashboard/tenant_page/user_management/roles/Index',
            compact(
                'title',
                'userLogin',
                'permissions',
                'indexMenuActive',
                'titleNav',
                'rolesDatas',
                'superAdminCount',
                'staffCount',
                'memberCount',
                'modalCreate',
                'logoutUrl',
                'modalAddPermission',
                'rolesDetail',
                'permissionLists',
            )
        );
    }

    public function CreateUser(UserCredentialRequest $request)
    {
        $requestValidated = $request->validated();
        $path_image_profile = "public/tenant-" . tenant("id") . "/assets/images/profile";

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

    public function UpdateUser(Request $request, User $user)
    {
        $user->load("TenantCredential");

        $validated = $request->validate([
            "profileImg" => ["max:1024"],
            "username" => ["required", "unique:tenant_credentials,username," . $user->TenantCredential->id],
            "role" => ["required"],
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|unique:tenant_credentials,email," . $user->TenantCredential->id,
            "phone_number" => "required|numeric",
            "password" => "confirmed"
        ]);

        $userCredentialData = [
            "username" => $validated["username"],
            "role" => $validated["role"],
            "first_name" => $validated["first_name"],
            "last_name" => $validated["last_name"],
            "password" => $validated["password"] ? Hash::make($validated["password"]) : $user->TenantCredential->password,
            "email" => $validated["email"],
            "phone_number" => $validated["phone_number"]
        ];

        if ($request->hasFile("profileImg")) {
            $profileImg = $validated['profileImg'];
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
                "first_name" => $userCredentialData["first_name"],
                "last_name" => $userCredentialData["last_name"],
                "phone_number" => $userCredentialData["phone_number"],
                "profile_url" => $userCredentialData['profile_url']
            ]);

            $user->TenantCredential()->update([
                "username" => $userCredentialData["username"],
                "email" => $userCredentialData["email"],
                "password" => $userCredentialData['password'],
            ]);

            $user->removeRole($user->roles()->first()->name);
            $user->assignRole($userCredentialData['role']);

            DB::commit();
        } catch (\Throwable $err) {
            DB::rollBack();
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Failed update user profile");
        }

        return redirect()->back()->with("message_success", "Success update user profile");
    }

    public function CreateRole(Request $request)
    {
        $request->validate([
            "title" => "required|unique:roles,name"
        ]);

        try {
            Role::create([
                "name" => $request->title,
                "guard_name" => "tenant-web"
            ]);
        } catch (\Throwable $err) {
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Failed create new role");
        }

        return redirect()->back()->with("message_success", "Success create new role");
    }

    public function DeleteRole($id)
    {
        try {
            $findRole = Role::where("id", $id)->where("guard_name", "tenant-web");
            $findRole->delete();
        } catch (\Throwable $err) {
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Failed delete role");
        }

        return redirect()->back()->with("message_success", "Success delete role");
    }

    public function AssignPermissions(Request $request, $id)
    {
        $validated = $request->validate([
            "permissions" => "required"
        ]);


        try {
            $findRoles = Role::where("id", $id)->where("guard_name", "tenant-web")->first();
            $findRoles->syncPermissions($validated['permissions']);

            return redirect()->back()->with("message_success", "Success assigned permissions");
        } catch (\Throwable $err) {
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Failed assigned permissions");
        }
    }
}

<?php

namespace App\Http\Controllers\Tenancy\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            compact('titlePage', 'title', 'titleNav', 'indexMenuActive', 'userLogin')
        );
    }
}

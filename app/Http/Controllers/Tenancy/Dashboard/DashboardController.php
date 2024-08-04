<?php

namespace App\Http\Controllers\Tenancy\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $titlePage = tenant('name');
        $title = tenant("name") . " - " . "Dashboard";
        $logoutUrl = "tenant-dashboard.logout";
        $userLogin = Auth::guard("tenant-web")->user();

        return Inertia::render(
            'dashboard/tenant_page/MainMenu',
            compact('title', 'titlePage', 'logoutUrl', 'userLogin')
        );
    }
}

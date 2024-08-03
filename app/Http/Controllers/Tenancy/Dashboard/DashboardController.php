<?php

namespace App\Http\Controllers\Tenancy\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $titlePage = tenant('name');
        $title = tenant("name") . " - " . "Dashboard";

        return Inertia::render(
            'dashboard/tenant_page/MainMenu',
            compact('title', 'titlePage')
        );
    }
}

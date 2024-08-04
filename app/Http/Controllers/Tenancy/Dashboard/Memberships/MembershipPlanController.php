<?php

namespace App\Http\Controllers\Tenancy\Dashboard\Memberships;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MembershipPlanController extends Controller
{
    public function Page()
    {
        $titlePage = tenant('name');
        $title = tenant("name") . " - " . "Membership plan";
        $titleNav = "Membership management";
        $indexMenuActive = 2;

        return Inertia::render(
            "dashboard/tenant_page/membership_page/plan/Index",
            compact(
                "titlePage",
                "title",
                "titleNav",
                "indexMenuActive"
            )
        );
    }
}

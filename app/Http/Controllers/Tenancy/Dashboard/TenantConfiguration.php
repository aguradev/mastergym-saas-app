<?php

namespace App\Http\Controllers\Tenancy\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Gym\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TenantConfiguration extends Controller
{
    public function UpdateTenantSubmmited(Request $request, Tenant $tenant)
    {
        $validated = $request->validate([
            "gym_title" => "required",
            "address" => "required",
            "gym_email" => "required",
            "va_number" => "required"
        ]);

        try {
            $requestValidated = [
                "name" => $validated['gym_title'],
                "address" => $validated['address'],
                "email" => $validated['gym_email'],
                "virtual_account_number" => $validated['va_number']
            ];

            $tenant->update($requestValidated);

            return redirect()->back()->with("message_success", "Success update tenant profile");
        } catch (\Throwable $err) {
            Log::error($err->getMessage());
            return redirect()->back()->with("message_error", "Failed update tenant profile");
        }
    }
}

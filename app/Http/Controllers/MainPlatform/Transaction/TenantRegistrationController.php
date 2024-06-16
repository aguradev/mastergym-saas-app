<?php

namespace App\Http\Controllers\MainPlatform\Transaction;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class TenantRegistrationController extends Controller
{
    public function RegistrationPage()
    {
        return Inertia::render("transactions/tenant_register");
    }
}

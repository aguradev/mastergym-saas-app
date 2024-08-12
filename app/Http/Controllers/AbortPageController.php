<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AbortPageController extends Controller
{
    public function UnauthorizationPage()
    {
        return Inertia::render('errors/unauthorization');
    }
}

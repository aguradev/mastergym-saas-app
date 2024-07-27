<?php

use App\Mail\InvoicePaidMail;
use App\Mail\TestMail;
use App\Models\Auth\TenantCredential;
use App\Models\CentralModel\User;
use App\Models\Gym\Tenant;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command("email:test", function () {
    Mail::send(new TestMail());
    $this->comment("check your mail!");
})->purpose('Testing sending email');

Artisan::command("email:invoice-paid-test", function () {
    Mail::send(new InvoicePaidMail("agungrageshwara24@gmail.com"));
    $this->comment("check your mail!");
});

<?php

namespace App\Http\Middleware\Central;

use App\Models\CentralModel\TenantTransaction;
use Closure;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class VerifyTransactionToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->query("token");

        $decryptionToken = null;

        if (!$token) {
            abort(404);
        }

        try {
            $decryptionToken = Crypt::decrypt($token);
        } catch (DecryptException $err) {
            Log::error($err->getMessage());
            abort(404, "Have a problem to decryption");
        }

        $findTransactionId = TenantTransaction::where('transaction_token_access', $decryptionToken)->exists();

        if (!$findTransactionId) {
            abort(404);
        }

        return $next($request);
    }
}

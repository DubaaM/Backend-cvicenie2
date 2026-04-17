<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PremiumOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Neautentifikovaný používateľ.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($user->role === 'admin') {
            return $next($request);
        }

        if (!$user->premium_until || $user->premium_until < now()) {
            return response()->json([
                'message' => 'Táto operácia je dostupná iba pre prémiových používateľov.',
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}

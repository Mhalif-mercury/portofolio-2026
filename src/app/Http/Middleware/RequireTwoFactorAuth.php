<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequireTwoFactorAuth
{
    public function handle(Request $request, Closure $next): mixed
    {
        $user = $request->user();

        if (! $user) {
            return $next($request);
        }

        if (! method_exists($user, 'hasTwoFactorEnabled') || ! $user->hasTwoFactorEnabled()) {
            return $next($request);
        }

        if ($request->session()->has('2fa.confirmed')) {
            return $next($request);
        }

        $challengeRoute = 'filament.admin.two-factor-challenge';
        $setupRoute = 'filament.admin.pages.two-factor-setup';

        if ($request->routeIs($challengeRoute) || $request->routeIs($setupRoute)) {
            return $next($request);
        }

        return redirect()->route($challengeRoute);
    }
}

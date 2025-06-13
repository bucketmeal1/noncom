<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminRoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (Auth::check() && ! $user->hasRole('Admin')) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
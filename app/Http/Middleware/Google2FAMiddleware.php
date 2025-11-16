<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Google2FAMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $admin = Auth::guard('admin')->user();

        if ($admin && $admin->google2fa_enabled) {
            if (!session('google2fa_verified')) {
                if (!$request->is('admin/2fa/verify', 'admin/2fa/verify/*')) {
                    return redirect()->route('admin.2fa.verify');
                }
            }
        }

        return $next($request);
    }
}

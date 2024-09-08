<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectifAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('doctor/*') || $request->is('doctor')) {
            if (Auth::guard('doctor')->check()) {
                return redirect()->route("doctor.dashboard");
            }
        }

        if ($request->is('employee/*') || $request->is('employee')) {
            if (Auth::guard('employee')->check()) {
                return redirect()->route("employee.dashboard");
            }
        }

        if ($request->is('pateint/auth')) {
            if (Auth::guard('patient')->check()) {
                return redirect()->route("frontend.home");
            }
        }

    
        return $next($request);
    }
}

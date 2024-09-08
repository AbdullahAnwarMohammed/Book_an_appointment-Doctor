<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        

        if ($request->is('doctor/*') || $request->is('doctor')) {
            if (!Auth::guard('doctor')->check()) {
                return redirect()->route('frontend.auth.create.dashboard');
            }
        }
        if ($request->is('employee/*') || $request->is('employee')) {
            if (!Auth::guard('employee')->check() && !Auth::guard('doctor')->check()) {
                return redirect()->route('frontend.auth.create.dashboard');
            }
        }

        if ($request->is('auth/patient/')) {
            if (!Auth::guard('patient')->check()) {
                return redirect()->route('frontend.home');
            }
        }
        if ($request->is('patient/*') || $request->is('patient')) {
            if (!Auth::guard('patient')->check()) {
                return redirect()->route('frontend.auth.create.patient');
            }
        }
     
    
        return $next($request);
    }
}

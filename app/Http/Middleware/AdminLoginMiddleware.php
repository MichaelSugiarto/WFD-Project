<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!(session('email') && session('role'))){
            $request->session()->put('url.intended', $request->fullUrl());
            return redirect()->route('admin.login')->with('invalidLogin', 'Please Login Again');
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ... $role): Response
    {
        if(!(session('email') && session('role'))){
            return redirect()->route('admin.login')->with('invalidLogin', 'Please Login First');
        }

        if(!in_array(session('role'), $role)){
            return redirect()->back()->with('error', 'You are not have an autorithy to access this page');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the role of "admin"
        if ($request->user() &&( $request->user()->role === 'Admin'||$request->user()->role === 'Account')) {
            return $next($request);
        }

        // If the user is not an admin, you can redirect or show an error message
        // For example, you can redirect to the home page with an error message
        Alert::error('ليس لديك الصلاحيه للدخول ');
        return redirect()->route('login')->with('error', 'You are not authorized to access this page.');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the custom session user_id exists
        if (!session()->has('user_id')) {
            return redirect()->route('login')->withErrors(['email' => 'Please sign in first to access the expense tracker portal.']);
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanAccessFilament
{
    public function handle(Request $request, Closure $next): Response
    {
        // Ensure the user is authenticated and has the "admin" role
        if ($request->user() && $request->user()->hasRole('admin')) {
            return $next($request);
        }

        // Redirect to home or show unauthorized message if not allowed
        return redirect('/admin')->withErrors(['message' => 'Access denied. Only admins can access this section.']);
    }
}

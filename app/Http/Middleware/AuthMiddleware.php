<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         // Check if the user is authenticated
         if (!Auth::check()) {
            // If not authenticated, redirect to login page or return an unauthorized response
            return redirect()->route('login');
            // Or return a JSON response
            // return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}

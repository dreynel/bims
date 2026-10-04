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
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        $userRole = $request->user()->role;

        if (!in_array($userRole, $roles)) {
            if ($userRole === 'resident') {
                return redirect()->route('resident.dashboard')
                    ->with('error', 'Access restricted to Barangay Officials (Punong Barangay and Secretary).');
            }

            return redirect()->route('admin.dashboard')
                ->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}

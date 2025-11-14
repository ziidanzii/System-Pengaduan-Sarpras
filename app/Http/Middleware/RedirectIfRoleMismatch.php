<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfRoleMismatch
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = strtolower(Auth::user()->role);
        
        // DEBUG: Log untuk melihat role dan roles yang diterima
        \Log::debug('RedirectIfRoleMismatch Debug', [
            'user_role' => $userRole,
            'expected_roles' => $roles,
            'user_id' => Auth::id(),
            'user' => Auth::user()->username,
            'in_array_result' => in_array($userRole, $roles),
        ]);

        if (!in_array($userRole, $roles)) {
            switch ($userRole) {
                case 'admin':
                    return redirect()->route('admin.dashboard');

                case 'petugas':
                    return redirect()->route('petugas.dashboard');

                case 'pengguna':
                    return redirect()->route('user.dashboard');

                default:
                    abort(403, 'Akses ditolak.');
            }
        }

        return $next($request);
    }
}

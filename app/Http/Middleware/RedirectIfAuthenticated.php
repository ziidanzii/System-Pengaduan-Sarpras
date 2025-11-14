<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, ...$guards)
    {
        // Jika user SUDAH login
        if (Auth::check()) {

            $guestRoutes = [
                'login',
                'login.post',
                'register',
                'register.post'
            ];

            // Ambil nama route saat ini
            $currentRoute = $request->route() ? $request->route()->getName() : null;

            // Jika user mencoba akses halaman login/register
            if (in_array($currentRoute, $guestRoutes)) {

                $role = strtolower(Auth::user()->role);

                // Redirect sesuai role
                if ($role === 'admin') {
                    return redirect()->route('admin.dashboard');

                } elseif ($role === 'petugas') {
                    return redirect()->route('petugas.dashboard');

                } else {
                    return redirect()->route('user.dashboard');
                }
            }
        }

        return $next($request);
    }
}

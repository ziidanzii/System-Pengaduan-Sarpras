<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama_pengguna' => 'required|string|max:200',
            'username'      => 'required|unique:users',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'nama_pengguna' => $request->nama_pengguna,
            'username'      => $request->username,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'role'          => 'pengguna',
        ]);

        Auth::login($user);
        return redirect()->route('user.dashboard');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek apakah input berupa email atau username
        $field = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Optimize query dengan select specific fields
        $user = User::select('id', 'nama_pengguna', 'username', 'email', 'password', 'role')
                    ->where($field, $request->login)
                    ->first();

        // Wrap Hash::check in a try/catch to handle cases where the stored
        // password does not use the expected hashing algorithm (e.g. not
        // a bcrypt hash). Without this, Laravel's BcryptHasher throws a
        // RuntimeException and results in a 500 error.
        try {
            $passwordMatches = $user && Hash::check($request->password, $user->password);
        } catch (\RuntimeException $e) {
            // Return a friendly error explaining the problem and actions to take.
            return back()->withErrors([
                'login' => 'Stored password for this account uses an unsupported hashing algorithm. Please reset the user password or re-hash it to match your app hashing configuration.',
            ])->withInput($request->only('login'));
        }

        if ($passwordMatches) {
            // Handle remember me functionality
            $remember = $request->has('remember');
            Auth::login($user, $remember);

            // Redirect based on role
            $role = strtolower($user->role);
            if ($role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            } elseif ($role === 'petugas') {
                return redirect()->intended(route('petugas.dashboard'));
            } else {
                return redirect()->intended(route('user.dashboard'));
            }
        }

        return back()->withErrors([
            'login' => 'Email/Username atau Password salah!',
        ])->withInput($request->only('login'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}

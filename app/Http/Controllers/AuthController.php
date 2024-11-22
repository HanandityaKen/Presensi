<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showUserLoginForm()
    {
        return view('auth.user-login');
    }

    public function userLoginProses(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::guard('user')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return back()->withErrors([
                'username' => 'Username yang Anda masukkan salah',
                'password' => 'Password yang Anda masukkan salah',
            ]);
        }

        return redirect()->intended('/dashboard');
    }

    public function logoutUser(Request $request)
    {
        Auth::guard('user')->logout();

        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); // Regenerasi token CSRF
    
        return redirect()->route('user.login');
    }


    public function showAdminLoginForm()
    {
        return view('auth.admin-login');
    }

    public function adminLoginProses(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return back()->withErrors([
                'username' => 'Username yang Anda masukkan salah',
                'password' => 'Password yang Anda masukkan salah',
            ]);
        }

        return redirect()->intended(route('admin.user.index'));

    }

    public function logoutAdmin(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); // Regenerasi token CSRF
    
        return redirect()->route('admin.login');
    }
}

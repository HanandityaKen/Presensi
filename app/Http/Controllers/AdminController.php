<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    
    public function profileAdmin()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.profile-admin', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'display_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admin,username,' . Auth::guard('admin')->user()->id,
            'old-password' => 'required|string',
            'new-password' => 'nullable|string|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();

        // Verifikasi password lama
        if (!Hash::check($request->input('old-password'), $admin->password)) {
            return back()->withErrors(['old-password' => 'Password lama tidak sesuai.']);
        }

        // Update profil
        $admin->display_name = $request->input('display_name');
        $admin->username = $request->input('username');

        // Jika password baru diisi, lakukan update
        if ($request->filled('new-password')) {
            $admin->password = Hash::make($request->input('new-password'));
        }

        $admin->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

}

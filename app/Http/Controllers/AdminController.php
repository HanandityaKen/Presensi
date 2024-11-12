<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function crudUser()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.crud-user', compact('admin'));
    }

    public function dataPresensi()
    {
        return view('admin.data-presensi');
    }

    public function createUserView()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.create-user', compact('admin'));
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan.');
    }

    public function editUser()
    {
        return view('admin.edit-user');
    }
}

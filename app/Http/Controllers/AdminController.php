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
    //User

    public function crudUser()
    {
        $admin = Auth::guard('admin')->user();

        $users = DB::table('user')
        ->join('role', 'user.role_id', '=', 'role.id')
        ->select('user.*', 'role.name as role')
        ->get();

        return view('admin.crud-user', compact('admin', 'users'));
    }

    public function createUserView()
    {
        $admin = Auth::guard('admin')->user();

        $roles = Role::all();

        return view('admin.create-user', compact('admin', 'roles'));
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'role'  => 'required|integer',
            'password' => 'required|string',
        ]);

        User::create([
            'username' => $request->username,
            'role_id'  => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('data.user')->with('success', 'User berhasil ditambahkan.');
    }

    public function editUser()
    {
        return view('admin.edit-user');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        $role->delete();

        return redirect()->route('role.index')->with('success', 'Role berhasil dihapus.');
    }

    //Data Presensi
    public function dataPresensi()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.data-presensi', compact('admin'));
    }

    public function profileAdmin()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.profile-admin', compact('admin'));
    }
}

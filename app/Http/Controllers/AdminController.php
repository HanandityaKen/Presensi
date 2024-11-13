<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    //User

    public function crudUser()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.crud-user', compact('admin'));
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

    //Data Presensi
    public function dataPresensi()
    {
        $admin = Auth::guard('admin')->user();

        return view('admin.data-presensi', compact('admin'));
    }

    //Role

    public function crudRole()
    {
        $admin = Auth::guard('admin')->user();

        $roles = Role::all();

        return view('admin.crud-role', compact('admin', 'roles'));
    }

    public function createRoleView()
    {
        $admin = Auth::guard('admin')->user();

        $roles = Role::paginate(10);


        return view('admin.create-role', compact('admin', 'roles'));
    }

    public function createRole(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        return redirect()->route('data.role.view')->with('success', 'Role berhasil ditambahkan.');
    }

    public function deleteRole($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        return redirect()->route('data.role.view')->with('success', 'Role berhasil dihapus.');
    }
}

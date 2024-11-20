<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        $users = DB::table('user')
        ->join('role', 'user.role_id', '=', 'role.id')
        ->select('user.*', 'role.name as role')
        ->get();

        return view('admin.crud-user', compact('admin', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $admin = Auth::guard('admin')->user();

        $roles = Role::all();

        return view('admin.create-user', compact('admin', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Auth::guard('admin')->user();

        $user = DB::table('user')
        ->join('role', 'user.role_id', '=', 'role.id')
        ->select('user.*', 'role.name as role')
        ->where('user.id', $id)
        ->first();

        $roles = Role::all();

        return view('admin.edit-user', compact('admin', 'user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'username' => 'required|string',
            'role'     => 'required|string',
            'password' => 'nullable|string',
        ]);

        $user = User::findOrFail($id);

        $user->username = $request->input('username');
        $user->role_id = $request->input('role');

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        {
            $user = User::findOrFail($id);
    
            $user->delete();
    
            return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus.');
        }
    }

    public function dashboard()
    {
        return view('user.dashboard-user');
    }

    public function presensi()
    {
        return view('user.presensi');
    }

    public function profileUser()
    {
        return view('user.profile-user');
    }
}

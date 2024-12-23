<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        $users = User::with('role')->get();

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

        $user = User::with('role')->findOrFail($id);

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

    public function profileUser()
    {
        $user = Auth::guard('user')->user();

        $connectGoogle = $user->gauth_id;

        return view('user.profile-user', compact('user', 'connectGoogle'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:user,username,' . Auth::guard('user')->user()->id,
            'old-password' => 'required|string',
            'new-password' => 'nullable|string|confirmed',
        ]);

        $user = Auth::guard('user')->user();

        // Verifikasi password lama
        if (!Hash::check($request->input('old-password'), $user->password)) {
            return back()->withErrors(['old-password' => 'Password lama tidak sesuai.']);
        }

        // Update profil
        $user->username = $request->input('username');

        // Jika password baru diisi, lakukan update
        if ($request->filled('new-password')) {
            $user->password = Hash::make($request->input('new-password'));
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image_url' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);
    
        $user = Auth::guard('user')->user();
    
        if ($user->image_url) {
            Storage::disk('public')->delete('user/' . $user->image_url);
        }
    
        $photo = $request->file('image_url');
        $photoName = $user->id . '_' . Str::uuid() . '.' . $photo->getClientOriginalExtension();
        $photo->storeAs('user', $photoName, 'public');
    
        $user->image_url = $photoName;
        $user->save();
    
        return redirect()->back()->with('success', 'Foto berhasil diunggah');
    }

    public function unlinkGoogle()
    {
        $user = Auth::guard('user')->user();

        $user->update([
            'email' => null,
            'gauth_id' => null,
            'gauth_type' => null,
        ]);

        return redirect()->back()->with('success', 'Koneksi ke Akun Google Anda telah berhasil diputuskan');
    }
    


}

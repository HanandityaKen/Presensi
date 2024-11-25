<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Presence;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class PresenceController extends Controller
{
    //admin
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        $presences = Presence::all();

        return view('admin.data-presensi', compact('admin', 'presences'));
    }

    //user

    public function dashboard()
    {
        $user = Auth::guard('user')->user();

        $presences = $user->presences()->orderBy('id', 'desc')->take(5)->get();

        $latestPresence = $user->presences()->orderBy('id', 'desc')->first();

        return view('user.dashboard-user', compact('user','presences', 'latestPresence'));
    }


    public function presenceForm()
    {
        $user = Auth::guard('user')->user();
        
        return view('user.presensi', compact('user'));
    }

    public function presenceProses(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string|exists:user,id',
            'work_place' => 'required|in:home,office',
            'foto' => 'required',
            'lokasi' => [      
                'required',
                'regex:/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?),\s?[-+]?((1[0-7]\d)|(\d{1,2}))(\.\d+)?$/',
            ],
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
        
            $extension = $file->getClientOriginalExtension();
            $uuid = Str::uuid()->toString(); 
            $filename = $uuid . '.' . $extension; 
        
            $path = Storage::disk('public')->putFileAs('foto_presensi', $file, $filename);
            
            $foto = $path;
        } elseif ($request->filled('foto') && preg_match('/^data:image\/(\w+);base64,/', $request->foto, $matches)) {
            $extension = strtolower($matches[1]); // Ekstensi file dari Base64
            $uuid = Str::uuid()->toString();
            $filename = $uuid . '.' . $extension;

            // Decode Base64 string
            $base64Image = substr($request->foto, strpos($request->foto, ',') + 1);
            $binaryImage = base64_decode($base64Image);

            // Simpan file hasil decode
            $path = 'foto_presensi/' . $filename;
            Storage::disk('public')->put($path, $binaryImage);

            $foto = $path;
        } else {
            return back()->withErrors(['foto' => 'Gambar tidak valid']);
        }
        
        Presence::create([
            'user_id' => $request->user_id,
            'location' => $request->lokasi,
            'presence_status' => 'clocked_in',
            'image_url' => $foto,
            'work_place' => $request->work_place,
        ]);

        return redirect()->route('dashboard')->with('success', 'Anda sudah melakukan presensi');
    }

    public function clocked_out(Request $request)
    {
        $user = Auth::guard('user')->user();
        $presence = $user->presences()->orderBy('id', 'desc')->first();

        if ($presence && $presence->presence_status === 'clocked_in') {
            $presence->update(['presence_status' => 'clocked_out']);
        }

        Auth::guard('user')->logout();

        $request->session()->invalidate(); 
        $request->session()->regenerateToken();

        return redirect()->route('user.login');
    }
}

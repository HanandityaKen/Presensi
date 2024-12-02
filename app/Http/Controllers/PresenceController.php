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

        $presences = Presence::orderBy('create_at', 'desc')->get();

        return view('admin.data-presensi', compact('admin', 'presences'));
    }

    //user

    public function dashboard()
    {
        $user = Auth::guard('user')->user();

        $presences = $user->presences()->orderBy('id', 'desc')->take(5)->get();

        return view('user.dashboard-user', compact('user', 'presences'));
    }


    public function presenceForm()
    {
        $user = Auth::guard('user')->user();
        
        return view('user.presensi', compact('user'));
    }

    public function presenceInProses(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string|exists:user,id',
            'work_place' => 'required|in:home,office',
            'foto' => 'required',
            'clock_in_time' => 'required|date_format:H:i',
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
            'image_url_in' => $foto,
            'clock_in_time' => $request->clock_in_time,
            'work_place' => $request->work_place,
        ]);

        session(['clocked_in' => true, 'clock_in_time' => $request->clock_in_time]);

        if (session()->has('clock_out_time')) {
            session()->forget('clock_out_time');
        }

        return redirect()->route('dashboard')->with('success', 'Anda sudah melakukan presensi');
    }

    public function presenceOutForm()
    {
        $user = Auth::guard('user')->user();
        
        return view('user.presensi-out', compact('user'));
    }

    public function presenceOutProses(Request $request)
    {
        $request->validate([
            'foto' => 'required',
            'clock_out_time' => 'required|date_format:H:i',
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

            $base64Image = substr($request->foto, strpos($request->foto, ',') + 1);
            $binaryImage = base64_decode($base64Image);

            $path = 'foto_presensi_out/' . $filename;
            Storage::disk('public')->put($path, $binaryImage);

            $foto = $path;
        } else {
            return back()->withErrors(['foto' => 'Gambar tidak valid']);
        }

        $user = Auth::guard('user')->user();

        $presence = $user->presences()
        ->whereNull('clock_out_time') 
        ->first();

        $presence->update([
            'image_url_out' => $foto,
            'clock_out_time' => $request->clock_out_time,
        ]);

        session(['clock_out_time' => $request->clock_out_time]);
        session()->forget('clocked_in');

        return redirect()->route('dashboard')->with('success', 'Anda sudah keluar');
    }

    public function riwayatPresensi()
    {
        $user = Auth::guard('user')->user();

        $presences = $user->presences()->orderBy('id', 'desc')->get();

        return view('user.riwayat-presensi', compact('user', 'presences'));
    }
}

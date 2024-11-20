<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Presence;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;


class PresenceController extends Controller
{
    public function dashboard()
    {
        $user = Auth::guard('user')->user();

        return view('user.dashboard-user', compact('user'));
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
            'foto' => 'required|mimes:jpeg,png',
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
        
            $path = $file->storeAs('public/foto_presensi', $filename); 
            
            $foto = $path;
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Exception;

class OauthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $currentUser = Auth::guard('user')->user();

            $googleUser = Socialite::driver('google')->user();

            $findUser = User::where('gauth_id', $googleUser->id)->first();

            //login
            if (!$findUser && !$currentUser) {
                return redirect()->route('user.login')->with('error', 'Akun Google Anda tidak ditemukan');
            }

            if (!$currentUser && $findUser) {
                Auth::guard('user')->login($findUser);

                return redirect()->route('dashboard');
            }

            //connect google
            if ($findUser && $findUser->id !== $currentUser->id) {
                return redirect()->route('profile.user')->with('error', 'Akun Google ini sudah terhubung ke pengguna lain');
            }

            if ($currentUser->gauth_id) {
                return redirect()->route('profile.user')->with('error', 'Anda sudah terhubung ke Google');
            }

            if ($currentUser->image_url) {
                Storage::disk('public')->delete('user/' . $currentUser->image_url);
            }
        
            $avatar = file_get_contents($googleUser->avatar);
            $photoName = $currentUser->id . '_' . Str::uuid() . '.jpg';
            Storage::disk('public')->put('user/' . $photoName, $avatar);
        
            $currentUser->update([
                'email' => $googleUser->email,
                'gauth_id' => $googleUser->id,
                'gauth_type' => 'google',
                'image_url' => $photoName,
            ]);

            return redirect()->route('profile.user')->with('success', 'Akun Google Anda sudah terhubung');

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}

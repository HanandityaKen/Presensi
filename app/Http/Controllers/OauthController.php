<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
            if (!$findUser) {
                return redirect()->route('user.login')->with('error', 'Akun Google Anda tidak ditemukan');
            }

            if (!$currentUser) {
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

            $currentUser->update([
                'gauth_id' => $googleUser->id,
                'gauth_type' => 'google',
                'email' => $googleUser->email,
            ]);

            return redirect()->route('profile.user')->with('success', 'Akun Google Anda sudah terhubung');

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}

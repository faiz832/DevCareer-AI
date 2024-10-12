<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // Mendapatkan informasi pengguna dari Google
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Cari pengguna berdasarkan email
            $user = User::where('email', $googleUser->getEmail())->first();

            // Jika pengguna belum ada, buat pengguna baru
            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'avatar' => $googleUser->getAvatar(),
                    'password' => bcrypt('password'), // bisa diisi dengan default password
                ]);
                $user->assignRole('student');
            }

            // Login pengguna
            Auth::login($user);

            // Redirect ke dashboard atau halaman yang diinginkan
            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            // Jika ada error, redirect kembali ke halaman login
            return redirect('/login')->with('error', 'Failed to login using Google');
        }
    }
}

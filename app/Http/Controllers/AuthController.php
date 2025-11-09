<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Database\Seeders\DefaultDataSeeder;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Set session
        session([
            'user_id' => $user->id,
            'user_name' => $user->name,
        ]);

        // Seed default data (POSISI SUDAH BENAR - setelah user dibuat dan session di-set)
        $seeder = new DefaultDataSeeder();
        $seeder->run($user->id);

        // Redirect ke dashboard setelah register
        return redirect()->route('dashboard')->with('success', 'Registrasi berhasil! Selamat datang, ' . $user->name . '.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            session([
                'user_id' => $user->id,
                'user_name' => $user->name,
            ]);

            // Redirect ke dashboard setelah login
            return redirect()->route('dashboard')->with('success', 'Login berhasil! Selamat datang kembali, ' . $user->name . '.');
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('login')->with('success', 'Anda telah logout dengan sukses.');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Tampilkan halaman profil
    public function show()
    {
        $user = User::find(session('user_id'));
        return view('profile.show', compact('user'));
    }

    // Tampilkan halaman edit profil
    public function edit()
    {
        $user = User::find(session('user_id'));
        return view('profile.edit', compact('user'));
    }

    // Update data profil
    public function update(Request $request)
    {
        $user = User::find(session('user_id'));

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:6',
        ]);

        // Update nama dan email
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password hanya kalau diisi
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Update session supaya nama terbaru muncul di navbar
        session(['user_name' => $user->name]);

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
    }
}

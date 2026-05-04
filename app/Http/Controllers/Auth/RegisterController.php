<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Tampilkan halaman form register
    public function show()
    {
        return view('auth.register');
        // ↑ nanti kita bikin file ini di Step 3
    }

    // Proses data dari form register
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            // confirmed = harus ada field password_confirmation
            // yang isinya sama dengan password
        ]);

        // Simpan user baru ke database
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            // Hash::make = enkripsi password biar aman
        ]);

        // Redirect ke halaman login setelah berhasil
        return redirect('/admin/login')
               ->with('success', 'Akun berhasil dibuat! Silakan login.');
    }
}

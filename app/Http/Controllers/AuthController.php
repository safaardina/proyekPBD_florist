<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function login()
    {
        return view('auth.login');
    }

    // Memproses login Super Admin
    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $akun = DB::select("
            SELECT iduser, username, password, idrole
            FROM `user`
            WHERE username = ?
              AND idrole = 1
            LIMIT 1
        ", [$request->username]);

        if (empty($akun)) {
            return back()->with('error', 'Username atau password salah.');
        }

        $akun = $akun[0];

        // Mendukung password lama yang masih berupa teks biasa
        // dan password yang sudah di-hash
        $passwordBenar = str_starts_with($akun->password, '$2y$')
            || str_starts_with($akun->password, '$argon')
            ? Hash::check($request->password, $akun->password)
            : hash_equals((string) $akun->password, (string) $request->password);

        if (!$passwordBenar) {
            return back()->with('error', 'Username atau password salah.');
        }

        // Ubah password lama menjadi hash setelah login berhasil
        if (!str_starts_with($akun->password, '$2y$')
            && !str_starts_with($akun->password, '$argon')) {

            DB::update("
                UPDATE `user`
                SET password = ?
                WHERE iduser = ?
            ", [
                Hash::make($request->password),
                $akun->iduser
            ]);
        }

        $request->session()->regenerate();

        session([
            'iduser' => $akun->iduser,
            'username' => $akun->username,
            'idrole' => $akun->idrole,
            'login' => true,
        ]);

        return redirect()->intended('/dashboard');
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

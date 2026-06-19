<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubmissionSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.index', [
            'title' => 'Login | FFH',
        ]);
    }

    public function register()
    {
        $categories = Category::query()
            ->where(function ($query) {
                $query->whereNull('is_active')->orWhere('is_active', true);
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        if (!SubmissionSetting::isOpen()) {
            return redirect()->back()->with('warning', 'Submission Telah Ditutup');
        }
        return view('auth.register', [
            'title' => 'Register | FFH',
            'categories' => $categories
        ]);
    }

    public function registStore(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:100',
            'no_hp'   => 'required|string|min:10|max:15|regex:/^[0-9]+$/',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|string|min:8',
            'category_id'    => 'required|exists:categories,id',
        ], [
            'name.required'  => 'Nama lengkap wajib diisi.',
            'no_hp.required'   => 'Nomor WhatsApp wajib diisi.',
            'no_hp.regex'      => 'Nomor WhatsApp hanya boleh berisi angka.',
            'no_hp.min'        => 'Nomor WhatsApp minimal 10 digit.',
            'email.required'         => 'Email wajib diisi.',
            'email.unique'           => 'Email sudah terdaftar.',
            'password.required'      => 'Password wajib diisi.',
            'password.min'           => 'Password minimal 8 karakter.',
            'category_id.required'    => 'Kategori wajib dipilih.',
        ]);

        User::create([
            'name'  => $request->name,
            'no_hp'   => $request->no_hp,
            'email'         => $request->email,
            'role'         => 'peserta',
            'password'      => Hash::make($request->password),
            'category_id'    => $request->category_id,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('toast_success', 'Berhasil Logout');
    }
}

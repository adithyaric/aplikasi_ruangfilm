<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index', [
            'title' => 'User Admin',
            'users' => User::Where('role', '!=', 'peserta')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create', [
            'title' => 'Tambah User',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        return redirect(route('users.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load([
            'detail',
            'films.category'
        ]);

        return view('user.show', [
            'title' => 'Detail User',
            'users' => $user,
            'detail' => $user->detail,
            'films' => $user->films,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', [
            'title' => 'Edit User',
            'users' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'no_hp' => 'nullable|string|max:20',
        ]);

        User::where('id', $user->id)->update($validatedData);
        if ($request->role == 'peserta') {
            return redirect(route('users.index.author'))->with('toast_success', 'Berhasil Menyimpan Data!');
        } else {
            return redirect(route('users.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return back()->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    public function changePass()
    {
        return view('user.change', [
            'title' => 'Ganti Password'
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return back()->with('toast_error', 'Password Lama Tidak Sesuai');
        }


        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect('/dashboard')->with('toast_success', 'Password Berhasil Dirubah');
    }

    public function indexAuth()
    {
        return view('user.indexAuth', [
            'title' => 'User Author',
            'users' => User::Where('role', 'peserta')->latest()->get(),
        ]);
    }

    public function indexKur()
    {
        return view('user.index', [
            'title' => 'User Kurator & Juri',
            'users' => User::whereIn('role', ['kurator', 'juri'])->latest()->get(),
        ]);
    }
}

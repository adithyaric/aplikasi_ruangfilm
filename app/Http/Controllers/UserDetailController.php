<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;
use Laravolt\Indonesia\Models\Province;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Biodata Peserta';
        $detail   = UserDetail::where('user_id', auth()->id())->first();
        $provinsi = Province::orderBy('name')->get();

        return view('user-detail.create', compact('detail', 'provinsi', 'title'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'provinsi_code'  => 'required',
            'provinsi_name'  => 'required',
            'kabupaten_code' => 'required',
            'kabupaten_name' => 'required',
            'kecamatan_code' => 'required',
            'kecamatan_name' => 'required',
            'desa_code'      => 'required',
            'desa_name'      => 'required',
            'alamat_lengkap' => 'required|string',
            'community_name' => 'required|string|max:255',
            'username_ig'    => 'required|string|max:255',
            'posisi'         => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
        ], [
            'provinsi_code.required'  => 'Provinsi wajib dipilih.',
            'kabupaten_code.required' => 'Kabupaten/Kota wajib dipilih.',
            'kecamatan_code.required' => 'Kecamatan wajib dipilih.',
            'desa_code.required'      => 'Desa/Kelurahan wajib dipilih.',
            'alamat_lengkap.required' => 'Alamat lengkap wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.date'     => 'Format tanggal lahir tidak valid.',
        ]);

        UserDetail::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'community_name' => $request->community_name,
                'provinsi_code'  => $request->provinsi_code,
                'provinsi_name'  => $request->provinsi_name,
                'kabupaten_code' => $request->kabupaten_code,
                'kabupaten_name' => $request->kabupaten_name,
                'kecamatan_code' => $request->kecamatan_code,
                'kecamatan_name' => $request->kecamatan_name,
                'desa_code'      => $request->desa_code,
                'desa_name'      => $request->desa_name,
                'username_ig'    => $request->username_ig,
                'posisi'         => $request->posisi,
                'alamat_lengkap' => $request->alamat_lengkap,
                'tanggal_lahir'  => $request->tanggal_lahir,
            ]
        );

        return redirect()->route('user-detail.index')
            ->with('success', 'Biodata berhasil disimpan.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function show(UserDetail $userDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(UserDetail $userDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserDetail $userDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDetail $userDetail)
    {
        //
    }
}

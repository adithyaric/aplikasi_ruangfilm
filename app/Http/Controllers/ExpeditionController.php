<?php

namespace App\Http\Controllers;

use App\Models\Expedition;
use App\Services\Shipping\RajaOngkirCourierNormalizer;
use Illuminate\Http\Request;

class ExpeditionController extends Controller
{
    public function index()
    {
        return view('expedition.index', [
            'title' => 'Data Expedisi',
            'expeditions' => Expedition::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('expedition.create', [
            'title' => 'Tambah Expedisi',
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        Expedition::create(array_merge($validated, [
            'is_active' => $request->boolean('is_active', true),
        ]));

        return redirect()->route('expeditions.index')
            ->with('toast_success', 'Expedisi berhasil disimpan.');
    }

    public function edit(Expedition $expedition)
    {
        return view('expedition.edit', [
            'title' => 'Edit Expedisi',
            'expedition' => $expedition,
        ]);
    }

    public function update(Request $request, Expedition $expedition)
    {
        $validated = $this->validateRequest($request);

        $expedition->update(array_merge($validated, [
            'is_active' => $request->boolean('is_active'),
        ]));

        return redirect()->route('expeditions.index')
            ->with('toast_success', 'Expedisi berhasil diperbarui.');
    }

    public function destroy(Expedition $expedition)
    {
        $expedition->delete();

        return back()->with('toast_success', 'Expedisi berhasil dihapus.');
    }

    protected function validateRequest(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'external_code' => 'required|string|max:100',
            'service_name' => 'nullable|string|max:255',
            'fee' => 'required|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['external_code'] = RajaOngkirCourierNormalizer::normalize($validated['external_code']);

        return $validated;
    }
}

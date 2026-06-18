<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\SubmissionSetting;
use Illuminate\Http\Request;

class SubmissionSettingController extends Controller
{
    public function index()
    {
        return view('setting', [
            'title' => 'Setting Submission',
            'setting' => SubmissionSetting::current(),
            'submissionPeriods' => SubmissionSetting::orderByDesc('open_at')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePeriod($request);

        if (SubmissionSetting::overlaps($validated['open_at'], $validated['close_at'])) {
            return back()->withErrors([
                'open_at' => 'Periode submission tidak boleh tumpang tindih dengan periode lain.',
            ])->withInput();
        }

        SubmissionSetting::create($validated);

        return redirect()->route('settingIndex')
            ->with('success', 'Periode submission berhasil disimpan.');
    }

    public function edit(SubmissionSetting $submissionSetting)
    {
        return view('submission-setting.edit', [
            'title' => 'Edit Periode Submission',
            'submissionSetting' => $submissionSetting,
        ]);
    }

    public function update(Request $request, SubmissionSetting $submissionSetting)
    {
        $validated = $this->validatePeriod($request);

        if (SubmissionSetting::overlaps($validated['open_at'], $validated['close_at'], $submissionSetting->id)) {
            return back()->withErrors([
                'open_at' => 'Periode submission tidak boleh tumpang tindih dengan periode lain.',
            ])->withInput();
        }

        $submissionSetting->update($validated);

        return redirect()->route('settingIndex')
            ->with('success', 'Periode submission berhasil diperbarui.');
    }

    public function destroy(SubmissionSetting $submissionSetting)
    {
        $submissionSetting->delete();

        return back()->with('success', 'Periode submission berhasil dihapus.');
    }

    public function updateGeneral(Request $request)
    {
        $validated = $request->validate([
            'payment_due_hours' => 'required|integer|min:1|max:168',
        ]);

        AppSetting::setValue('payment_due_hours', $validated['payment_due_hours']);

        return back()->with('success', 'Setting pembayaran berhasil diperbarui.');
    }

    protected function validatePeriod(Request $request)
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'open_at' => 'required|date',
            'close_at' => 'required|date|after:open_at',
        ], [
            'close_at.after' => 'Waktu penutupan harus setelah waktu pembukaan.',
        ]);
    }
}

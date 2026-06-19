<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\SubmissionSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubmissionSettingController extends Controller
{
    public function index()
    {
        $currentSetting = SubmissionSetting::current();

        return view('setting', [
            'title' => 'Setting Submission',
            'setting' => $currentSetting,
            'landingSetting' => $currentSetting,
            'submissionPeriods' => SubmissionSetting::orderByDesc('open_at')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePeriod($request, 'periodForm');

        if (SubmissionSetting::overlaps($validated['open_at'], $validated['close_at'])) {
            return back()->withErrors([
                'open_at' => 'Periode submission tidak boleh tumpang tindih dengan periode lain.',
            ], 'periodForm')->withInput();
        }

        SubmissionSetting::create(array_merge(
            $this->cloneLandingPayload(SubmissionSetting::current()),
            $validated
        ));

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

    public function updateLanding(Request $request, SubmissionSetting $submissionSetting)
    {
        $validated = $this->validateLanding($request, 'landingForm');
        $oldImages = $this->collectSettingImages($submissionSetting);
        $payload = $this->prepareLandingPayload($request, $validated, $submissionSetting);

        $submissionSetting->update($payload);
        $this->deleteUnusedImages($oldImages, $this->collectImagePathsFromPayload($payload));

        return redirect()->route('settingIndex')
            ->with('success', 'Setting landing page berhasil diperbarui.');
    }

    public function destroy(SubmissionSetting $submissionSetting)
    {
        $images = $this->collectSettingImages($submissionSetting);

        $submissionSetting->delete();

        foreach ($images as $path) {
            $this->deleteStoredImage($path);
        }

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

    protected function validatePeriod(Request $request, $bag = null)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'open_at' => 'required|date',
            'close_at' => 'required|date|after:open_at',
        ];

        $messages = [
            'close_at.after' => 'Waktu penutupan harus setelah waktu pembukaan.',
        ];

        return $bag
            ? $request->validateWithBag($bag, $rules, $messages)
            : $request->validate($rules, $messages);
    }

    protected function validateLanding(Request $request, $bag = null)
    {
        $rules = [
            'hero_title' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'about_title' => 'nullable|string|max:255',
            'about_description' => 'nullable|string',
            'about_description_secondary' => 'nullable|string',
            'about_image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'hashtag' => 'nullable|string|max:255',
            'theme_title' => 'nullable|string|max:255',
            'theme_name' => 'nullable|string|max:255',
            'theme_quote' => 'nullable|string',
            'theme_description' => 'nullable|string',
            'theme_image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'festival_board' => 'nullable|array',
            'festival_board.*.name' => 'nullable|string|max:255',
            'festival_board.*.title' => 'nullable|string|max:255',
            'festival_board_images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'last_year_title' => 'nullable|string|max:255',
            'last_year_description' => 'nullable|string',
            'last_year_catalog_label' => 'nullable|string|max:255',
            'last_year_catalog_url' => 'nullable|string|max:255',
        ];

        return $bag
            ? $request->validateWithBag($bag, $rules)
            : $request->validate($rules);
    }

    protected function prepareLandingPayload(Request $request, array $validated, SubmissionSetting $submissionSetting = null)
    {
        $payload = $validated;

        $payload['hero_image'] = $this->storeOrKeepImage($request, 'hero_image', optional($submissionSetting)->hero_image);
        $payload['about_image'] = $this->storeOrKeepImage($request, 'about_image', optional($submissionSetting)->about_image);
        $payload['theme_image'] = $this->storeOrKeepImage($request, 'theme_image', optional($submissionSetting)->theme_image);
        $payload['festival_board'] = $this->buildBoardMembers($request, $submissionSetting);
        $payload['last_year_catalog_url'] = $request->filled('last_year_catalog_url')
            ? trim($request->last_year_catalog_url)
            : null;

        unset($payload['festival_board_images']);

        return $payload;
    }

    protected function cloneLandingPayload(SubmissionSetting $submissionSetting = null)
    {
        $payload = [];

        foreach ($this->landingFields() as $field) {
            if ($field === 'festival_board') {
                $payload[$field] = $submissionSetting ? ($submissionSetting->festival_board ?: []) : [];
                continue;
            }

            $payload[$field] = optional($submissionSetting)->{$field};
        }

        return $payload;
    }

    protected function landingFields()
    {
        return [
            'hero_title',
            'hero_description',
            'hero_image',
            'about_title',
            'about_description',
            'about_description_secondary',
            'about_image',
            'hashtag',
            'theme_title',
            'theme_name',
            'theme_quote',
            'theme_description',
            'theme_image',
            'festival_board',
            'last_year_title',
            'last_year_description',
            'last_year_catalog_label',
            'last_year_catalog_url',
        ];
    }

    protected function buildBoardMembers(Request $request, SubmissionSetting $submissionSetting = null)
    {
        $existingMembers = collect(optional($submissionSetting)->festival_board ?: []);
        $inputMembers = collect($request->input('festival_board', []));
        $uploadedImages = $request->file('festival_board_images', []);

        $members = [];

        foreach ($inputMembers as $index => $currentMember) {
            $name = trim((string) ($currentMember['name'] ?? ''));
            $title = trim((string) ($currentMember['title'] ?? ''));
            $image = data_get($existingMembers->get($index), 'image');

            if (isset($uploadedImages[$index])) {
                $image = $uploadedImages[$index]->store('landing-settings/board', 'public');
            }

            if ($name !== '' || $title !== '' || $image) {
                $members[] = [
                    'name' => $name,
                    'title' => $title,
                    'image' => $image,
                ];
            }
        }

        return array_values($members);
    }

    protected function storeOrKeepImage(Request $request, $field, $existingPath = null)
    {
        if ($request->hasFile($field)) {
            return $request->file($field)->store('landing-settings', 'public');
        }

        return $existingPath;
    }

    protected function collectSettingImages(SubmissionSetting $submissionSetting)
    {
        $boardImages = collect($submissionSetting->festival_board ?: [])
            ->pluck('image')
            ->filter()
            ->values()
            ->all();

        return array_values(array_filter(array_merge([
            $submissionSetting->hero_image,
            $submissionSetting->about_image,
            $submissionSetting->theme_image,
        ], $boardImages)));
    }

    protected function collectImagePathsFromPayload(array $payload)
    {
        $boardImages = collect($payload['festival_board'] ?? [])
            ->pluck('image')
            ->filter()
            ->values()
            ->all();

        return array_values(array_filter(array_merge([
            $payload['hero_image'] ?? null,
            $payload['about_image'] ?? null,
            $payload['theme_image'] ?? null,
        ], $boardImages)));
    }

    protected function deleteUnusedImages(array $oldImages, array $newImages)
    {
        foreach (array_diff($oldImages, $newImages) as $path) {
            $this->deleteStoredImage($path);
        }
    }

    protected function deleteStoredImage($path)
    {
        if (
            $path
            && !preg_match('/^(https?:\/\/|landing\/|img\/|assets\/)/', $path)
            && !$this->isSubmissionImageStillUsed($path)
        ) {
            Storage::disk('public')->delete($path);
        }
    }

    protected function isSubmissionImageStillUsed($path)
    {
        return SubmissionSetting::query()
            ->where(function ($query) use ($path) {
                $query->where('hero_image', $path)
                    ->orWhere('about_image', $path)
                    ->orWhere('theme_image', $path)
                    ->orWhere('festival_board', 'like', '%' . $path . '%');
            })
            ->exists();
    }
}

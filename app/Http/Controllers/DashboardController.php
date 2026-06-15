<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DownloadLog;
use App\Models\Film;
use App\Models\SubmissionSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == 'peserta') {
            return $this->dashboardPeserta();
        } elseif ($user->role == 'admin' || $user->role == 'adminsub') {
            return $this->dashboardAdmin();
        }

        return view('dashboard');
    }

    private function dashboardPeserta()
    {
        $title = 'Dashboard';
        $userId = Auth::id();

        // Stat cards
        $totalFilm         = Film::where('user_id', $userId)->count();
        $dalamProses       = Film::where('user_id', $userId)->whereIn('status', [1, 2, 3])->count();
        $officialSelection = Film::where('user_id', $userId)->where('status', 4)->count();
        $ditolak           = Film::where('user_id', $userId)->where('status', 5)->count();

        // Tabel submission
        $submissions = Film::with(['user'])
            ->where('user_id', $userId)
            ->latest()
            ->get();

        // Pengumuman terbaru (kosong dulu, nanti sesuaikan modelnya)
        $pengumuman = collect();

        // Pesan terbaru (kosong dulu, nanti sesuaikan modelnya)
        $pesan = collect();

        return view('dashboard', compact(
            'totalFilm',
            'dalamProses',
            'officialSelection',
            'ditolak',
            'submissions',
            'pengumuman',
            'pesan',
            'title'
        ));
    }

    private function dashboardAdmin()
    {
        $title = 'Dashboard';
        // Stat cards admin
        $categories = Category::orderBy('name')->get();
        $totalFilm         = Film::count();
        $dalamProses       = Film::whereIn('status', [1, 2, 3])->count();
        $officialSelection = Film::where('status', 4)->count();
        $ditolak           = Film::where('status', 5)->count();
        $winner            = Film::where('status', 6)->count();
        $totalDownload     = DownloadLog::where('file', 'ekatalog-2025.pdf')->count();
        $downloadHariIni = DownloadLog::where('file', 'ekatalog-2025.pdf')
            ->whereDate('created_at', today())
            ->count();

        // Semua submission
        $submissions = Film::with(['user'])
            ->latest()
            ->get();

        // Pengumuman terbaru (kosong dulu)
        $pengumuman = collect();

        // Pesan terbaru (kosong dulu)
        $pesan = collect();

        return view('dashboard', compact(
            'totalFilm',
            'dalamProses',
            'officialSelection',
            'ditolak',
            'winner',
            'submissions',
            'pengumuman',
            'pesan',
            'title',
            'totalDownload',
            'downloadHariIni',
            'categories',
        ));
    }

    public function settingIndex()
    {
        $title = 'Setting Submission';
        $setting = SubmissionSetting::current();
        return view('setting', compact('setting', 'title'));
    }

    public function settingStore(Request $request)
    {
        $request->validate([
            'open_at'  => 'required|date',
            'close_at' => 'required|date|after:open_at',
        ], [
            'open_at.required'   => 'Waktu pembukaan wajib diisi.',
            'close_at.required'  => 'Waktu penutupan wajib diisi.',
            'close_at.after'     => 'Waktu penutupan harus setelah waktu pembukaan.',
        ]);

        SubmissionSetting::updateOrCreate(
            ['id' => 1],
            [
                'open_at'  => $request->open_at,
                'close_at' => $request->close_at,
            ]
        );

        return redirect()->route('settingIndex')
            ->with('success', 'Setting submission berhasil disimpan.');
    }

    public function settingDestroy()
    {
        SubmissionSetting::truncate();

        return redirect()->route('settingIndex')
            ->with('success', 'Setting submission berhasil dihapus.');
    }
}

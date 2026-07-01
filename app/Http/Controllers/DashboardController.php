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

        if ($user->isGeneralBuyer()) {
            return redirect()->route('orders.index')
                ->with('warning', 'Akun umum menggunakan halaman landing untuk belanja dan mengelola pesanan.');
        }

        if ($user->hasRole('peserta')) {
            return $this->dashboardPeserta();
        } elseif ($user->hasRole(['admin', 'adminsub', 'kurator', 'juri'])) {
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
        $dalamProses       = Film::where('user_id', $userId)
            ->whereIn('curation_status', [Film::CURATION_UNDER_REVIEW, Film::CURATION_DETERMINATION])
            ->count();
        $officialSelection = Film::where('user_id', $userId)
            ->where('curation_status', Film::CURATION_APPROVED)
            ->count();
        $ditolak           = Film::where('user_id', $userId)
            ->where('curation_status', Film::CURATION_REJECTED)
            ->count();

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
        $categories = Category::orderBy('name')->get();
        $totalFilm         = Film::count();
        $dalamProses       = Film::whereIn('curation_status', [Film::CURATION_PENDING, Film::CURATION_UNDER_REVIEW])->count();
        $officialSelection = Film::where('curation_status', Film::CURATION_APPROVED)->count();
        $ditolak           = Film::where('curation_status', Film::CURATION_REJECTED)->count();
        $winner            = Film::whereNotNull('winner_rank')->count();
        $totalDownload     = DownloadLog::where('file', 'ekatalog-2025.pdf')->count();
        $downloadHariIni = DownloadLog::where('file', 'ekatalog-2025.pdf')
            ->whereDate('created_at', today())
            ->count();

        $submissions = Film::with(['user.category', 'category', 'submissionSetting'])
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

}

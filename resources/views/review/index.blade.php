@extends('layouts.master')
@section('container')
@php
    $user = auth()->user();
    $isAdmin = $user->hasRole(['admin', 'adminsub']);
    $canCurate = $user->hasRole(['admin', 'adminsub', 'kurator']);
    $canJudge = $user->hasRole(['admin', 'adminsub', 'juri']);
    $statusClasses = [
        \App\Models\Film::CURATION_PENDING => 'warning',
        \App\Models\Film::CURATION_UNDER_REVIEW => 'info',
        \App\Models\Film::CURATION_APPROVED => 'primary',
        \App\Models\Film::CURATION_REJECTED => 'danger',
        'winner' => 'success',
    ];
@endphp
<section class="content-header">
    <h1>Review Submission</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <form method="GET" action="{{ route('review.index') }}" class="form-inline">
                        <div class="form-group">
                            <label>Periode</label>
                            <select name="submission_setting_id" class="form-control" style="margin:0 10px;">
                                <option value="">Semua Periode</option>
                                @foreach($submissionPeriods as $period)
                                <option value="{{ $period->id }}" {{ request('submission_setting_id') == $period->id ? 'selected' : '' }}>
                                    {{ $period->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="category_id" class="form-control" style="margin:0 10px;">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="curation_status" class="form-control" style="margin:0 10px;">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('curation_status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="under_review" {{ request('curation_status') === 'under_review' ? 'selected' : '' }}>Dalam Kurasi</option>
                                <option value="approved" {{ request('curation_status') === 'approved' ? 'selected' : '' }}>Official Selection</option>
                                <option value="rejected" {{ request('curation_status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ranking</label>
                            <select name="stage" class="form-control" style="margin:0 10px;">
                                @foreach($stageLabels as $stageValue => $stageLabel)
                                <option value="{{ $stageValue }}" {{ $stage === $stageValue ? 'selected' : '' }}>
                                    {{ $stageLabel }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>

                    @if($isAdmin)
                    <div style="margin-top:12px;">
                        <form method="POST" action="{{ route('review.start-curation') }}" class="form-inline" style="display:inline-block; margin-right:8px;">
                            @csrf
                            <input type="hidden" name="submission_setting_id" value="{{ request('submission_setting_id') }}">
                            <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                            <button type="submit" class="btn btn-warning btn-sm" {{ request('submission_setting_id') ? '' : 'disabled' }}>
                                Mulai Kurasi
                            </button>
                        </form>

                        @if(request('submission_setting_id') && request('category_id'))
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#officialSelectionModal">
                            Set Official Selection
                        </button>
                        @endif
                    </div>
                    @endif
                </div>
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Film</th>
                                <th>Peserta</th>
                                <th>Periode</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Nilai Kurasi</th>
                                <th>Nilai Juri</th>
                                <th>Peringkat</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($films as $film)
                            @php
                                $curationReviews = $film->submissionReviews->where('stage', \App\Models\ReviewRubric::STAGE_CURATION);
                                $juryReviews = $film->submissionReviews->where('stage', \App\Models\ReviewRubric::STAGE_JURY);
                                $statusClass = $statusClasses[$film->display_status] ?? 'default';
                            @endphp
                            <tr>
                                <td>
                                    <b>{{ $film->name }}</b><br>
                                    <small>{{ $film->sutradara }}</small><br>
                                    <a href="{{ route('film.show', $film) }}" class="btn btn-default btn-xs" style="margin-top:6px;">Detail</a>
                                </td>
                                <td>{{ $film->user->name ?? '-' }}</td>
                                <td>{{ $film->submissionSetting->name ?? '-' }}</td>
                                <td>{{ $film->category->name ?? '-' }}</td>
                                <td>
                                    <span class="label label-{{ $statusClass }}">{{ $film->display_status_label }}</span>
                                </td>
                                <td>
                                    <strong>{{ number_format($film->curation_average_score, 2) }}</strong><br>
                                    <small>{{ $film->curation_review_count }} kurator</small>
                                </td>
                                <td>
                                    <strong>{{ number_format($film->jury_average_score, 2) }}</strong><br>
                                    <small>{{ $film->jury_review_count }} juri</small>
                                </td>
                                <td>{{ $film->winner_rank ?? '-' }}</td>
                                <td style="min-width:240px;">
                                    @if($curationReviews->count())
                                    <div><strong>Kurator</strong></div>
                                    @foreach($curationReviews as $review)
                                    <div style="margin-bottom:4px;">
                                        <small>{{ $review->reviewer->name ?? 'Kurator' }} ({{ number_format((float) $review->total_score, 2) }}): {{ $review->note ?: '-' }}</small>
                                    </div>
                                    @endforeach
                                    @endif

                                    @if($isAdmin && $juryReviews->count())
                                    <div style="margin-top:8px;"><strong>Juri</strong></div>
                                    @foreach($juryReviews as $review)
                                    <div style="margin-bottom:4px;">
                                        <small>{{ $review->reviewer->name ?? 'Juri' }} ({{ number_format((float) $review->total_score, 2) }}): {{ $review->note ?: '-' }}</small>
                                    </div>
                                    @endforeach
                                    @endif
                                </td>
                                <td style="min-width:220px;">
                                    @if($canCurate && $film->curation_status === \App\Models\Film::CURATION_UNDER_REVIEW)
                                    <a href="{{ route('review.score', [$film, \App\Models\ReviewRubric::STAGE_CURATION]) }}" class="btn btn-warning btn-xs" style="margin-bottom:6px;">
                                        Nilai Kurasi
                                    </a>
                                    @endif

                                    @if($canJudge && $film->curation_status === \App\Models\Film::CURATION_APPROVED)
                                    <a href="{{ route('review.score', [$film, \App\Models\ReviewRubric::STAGE_JURY]) }}" class="btn btn-success btn-xs" style="margin-bottom:6px;">
                                        Nilai Juri
                                    </a>
                                    @endif

                                    @if($isAdmin && $film->curation_status === \App\Models\Film::CURATION_APPROVED)
                                    <form action="{{ route('review.winner-rank', $film) }}" method="POST" style="margin-top:8px;">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="winner_rank" class="form-control" value="{{ old('winner_rank', $film->winner_rank) }}" placeholder="Juara 1">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
                                            </span>
                                        </div>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="text-center text-muted">Belum ada submission.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @if($isAdmin && request('submission_setting_id') && request('category_id'))
    <div class="modal fade" id="officialSelectionModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('review.official-selection') }}">
                    @csrf
                    <input type="hidden" name="submission_setting_id" value="{{ request('submission_setting_id') }}">
                    <input type="hidden" name="category_id" value="{{ request('category_id') }}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Set Official Selection</h4>
                    </div>
                    <div class="modal-body">
                        @forelse($selectionFilms as $film)
                        <label style="display:block; border-bottom:1px solid #eee; padding:8px 0; font-weight:normal;">
                            <input type="checkbox" name="film_ids[]" value="{{ $film->id }}" {{ $film->curation_status === \App\Models\Film::CURATION_APPROVED ? 'checked' : '' }}>
                            <strong>{{ $film->name }}</strong>
                            <span class="text-muted">
                                - {{ $film->user->name ?? '-' }} - Nilai Kurasi {{ number_format($film->curation_average_score, 2) }}
                            </span>
                        </label>
                        @empty
                        <p class="text-muted">Tidak ada film berstatus Dalam Kurasi atau Official Selection pada periode dan kategori ini.</p>
                        @endforelse
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Simpan Official Selection</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</section>
@endsection

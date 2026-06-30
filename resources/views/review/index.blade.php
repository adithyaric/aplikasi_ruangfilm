@extends('layouts.master')
@section('container')
@php
    $user = auth()->user();
    $isAdmin = $user->hasRole(['admin', 'adminsub']);
    $canCurate = $user->hasRole('kurator');
    $canJudge = $user->hasRole('juri');
    $statusClasses = [
        \App\Models\Film::CURATION_PENDING => 'warning',
        \App\Models\Film::CURATION_UNDER_REVIEW => 'info',
        \App\Models\Film::CURATION_APPROVED => 'primary',
        \App\Models\Film::CURATION_REJECTED => 'danger',
        'winner' => 'success',
    ];
    $currentStageLabel = $stageLabels[$stage] ?? ucfirst($stage);
@endphp
<section class="content-header">
    <h1>Submission & Review</h1>
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
                                <option value="{{ $period->id }}" {{ (string) $selectedSubmissionSettingId === (string) $period->id ? 'selected' : '' }}>
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
                                <option value="{{ $category->id }}" {{ (string) $selectedCategoryId === (string) $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @if(!$canJudge)
                        <div class="form-group">
                            <label>Status</label>
                            <select name="curation_status" class="form-control" style="margin:0 10px;">
                                <option value="">Semua Status</option>
                                @foreach($statusLabels as $statusValue => $statusLabel)
                                <option value="{{ $statusValue }}" {{ $selectedCurationStatus === $statusValue ? 'selected' : '' }}>
                                    {{ $statusLabel }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @else
                        <input type="hidden" name="curation_status" value="{{ \App\Models\Film::CURATION_APPROVED }}">
                        @endif
                        <input type="hidden" name="stage" value="{{ $stage }}">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>

                    @if($isAdmin)
                    <div style="margin-top:12px;">
                        <form method="POST" action="{{ route('review.start-curation') }}" class="form-inline" style="display:inline-block; margin-right:8px;">
                            @csrf
                            <input type="hidden" name="submission_setting_id" value="{{ $selectedSubmissionSettingId }}">
                            <input type="hidden" name="category_id" value="{{ $selectedCategoryId }}">
                            <button type="submit" class="btn btn-warning btn-sm" {{ $selectedSubmissionSettingId ? '' : 'disabled' }}>
                                Mulai Kurasi
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:50px;">No</th>
                                <th>Nama Tim/Komunitas Produksi</th>
                                <th>Judul Film</th>
                                <th>Durasi Film</th>
                                <th>Tautan Film</th>
                                @foreach($rubricItems as $item)
                                <th>{{ $item->title }}</th>
                                @endforeach
                                <th>Total Nilai {{ $currentStageLabel }}</th>
                                <th>Nilai Per Reviewer</th>
                                <th>Status & Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($films as $film)
                            @php
                                $curationReviews = $film->submissionReviews->where('stage', \App\Models\ReviewRubric::STAGE_CURATION);
                                $juryReviews = $film->submissionReviews->where('stage', \App\Models\ReviewRubric::STAGE_JURY);
                                $visibleJuryReviews = $isAdmin ? $juryReviews : ($user->hasRole('juri') ? $juryReviews->where('reviewer_id', $user->id) : collect());
                                $statusClass = $statusClasses[$film->display_status] ?? 'default';
                                $currentAverage = $stage === \App\Models\ReviewRubric::STAGE_JURY ? $film->jury_average_score : $film->curation_average_score;
                                $currentCount = $stage === \App\Models\ReviewRubric::STAGE_JURY ? $film->jury_review_count : $film->curation_review_count;
                                $jam = floor($film->duration / 3600);
                                $menit = floor(($film->duration % 3600) / 60);
                                $sisa = $film->duration % 60;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $film->user->name ?? '-' }}</strong><br>
                                    <small>{{ $film->user->category->name ?? $film->category->name ?? '-' }}</small>
                                </td>
                                <td>
                                    <strong>{{ $film->name }}</strong><br>
                                    <small>{{ $film->sutradara }}</small>
                                </td>
                                <td>{{ sprintf('%02d:%02d:%02d', $jam, $menit, $sisa) }}</td>
                                <td>
                                    <a href="{{ $film->film }}" target="_blank" class="btn btn-default btn-xs">Film</a>
                                    <a href="{{ $film->trailer }}" target="_blank" class="btn btn-default btn-xs">Trailer</a>
                                    <a href="{{ route('film.show', $film) }}" class="btn btn-info btn-xs">Detail</a>
                                </td>
                                @foreach($rubricItems as $item)
                                @php
                                    $summary = $film->rubric_item_summaries->get($item->id);
                                @endphp
                                <td style="min-width:150px;">
                                    @if($summary && $summary['avg_weighted_score'] !== null)
                                    <strong>{{ number_format((float) $summary['avg_weighted_score'], 2) }}</strong><br>
                                    <small>Skor {{ number_format((float) $summary['avg_score'], 2) }}</small>
                                        @if($isAdmin)
                                        <div style="margin-top:4px;">
                                            @foreach($summary['reviewers'] as $reviewerScore)
                                            <div><small>{{ $reviewerScore['reviewer'] }}: {{ number_format((float) $reviewerScore['weighted_score'], 2) }}</small></div>
                                            @endforeach
                                        </div>
                                        @endif
                                    @else
                                    -
                                    @endif
                                </td>
                                @endforeach
                                <td>
                                    <strong>{{ number_format($currentAverage, 2) }}</strong><br>
                                    <small>{{ $currentCount }} reviewer</small>
                                </td>
                                <td style="min-width:260px;">
                                    @if($curationReviews->count())
                                    <div><strong>Kurator</strong></div>
                                    @foreach($curationReviews as $review)
                                    <div style="margin-bottom:4px;">
                                        <small>{{ $review->reviewer->name ?? 'Kurator' }}: {{ number_format((float) $review->total_score, 2) }}</small>
                                        @if($review->note)
                                        <br><small class="text-muted">{{ $review->note }}</small>
                                        @endif
                                    </div>
                                    @endforeach
                                    @endif

                                    @if($visibleJuryReviews->count())
                                    <div style="margin-top:8px;"><strong>Juri</strong></div>
                                    @foreach($visibleJuryReviews as $review)
                                    <div style="margin-bottom:4px;">
                                        <small>{{ $review->reviewer->name ?? 'Juri' }}: {{ number_format((float) $review->total_score, 2) }}</small>
                                        @if($review->note)
                                        <br><small class="text-muted">{{ $review->note }}</small>
                                        @endif
                                    </div>
                                    @endforeach
                                    @endif

                                    @if(!$curationReviews->count() && !$visibleJuryReviews->count())
                                    -
                                    @endif
                                </td>
                                <td style="min-width:220px;">
                                    <span class="label label-{{ $statusClass }}">{{ $film->display_status_label }}</span>

                                    <div style="margin-top:8px;">
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
                                    </div>

                                    @if($isAdmin)
                                    <form action="{{ route('review.status', $film) }}" method="POST" style="margin-top:8px;">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group input-group-sm">
                                            <select name="curation_status" class="form-control">
                                                @foreach($statusLabels as $statusValue => $statusLabel)
                                                <option value="{{ $statusValue }}" {{ $film->curation_status === $statusValue ? 'selected' : '' }}>
                                                    {{ $statusLabel }}
                                                </option>
                                                @endforeach
                                            </select>
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn btn-default btn-flat">Ubah</button>
                                            </span>
                                        </div>
                                    </form>
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

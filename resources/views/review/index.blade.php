@extends('layouts.master')
@section('container')
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
                            <label>Status Kurasi</label>
                            <select name="curation_status" class="form-control" style="margin:0 10px;">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('curation_status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ request('curation_status') === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ request('curation_status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
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
                                <th>Nilai Rata-rata</th>
                                <th>Peringkat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($films as $film)
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
                                    <span class="label label-{{ $film->display_status === 'winner' ? 'success' : ($film->display_status === 'approved' ? 'primary' : ($film->display_status === 'rejected' ? 'danger' : 'warning')) }}">
                                        {{ $film->display_status_label }}
                                    </span>
                                    @if($film->curator_note)
                                    <div style="margin-top:6px;"><small>{{ $film->curator_note }}</small></div>
                                    @endif
                                </td>
                                <td>{{ number_format($film->averageScore(), 2) }}</td>
                                <td>{{ $film->winner_rank ?? '-' }}</td>
                                <td style="min-width:280px;">
                                    @if(in_array(auth()->user()->role, ['admin', 'adminsub', 'kurator']))
                                    <form action="{{ route('review.curation', $film) }}" method="POST" style="margin-bottom:10px;">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group">
                                            <select name="curation_status" class="form-control input-sm">
                                                <option value="pending" {{ $film->curation_status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="approved" {{ $film->curation_status === 'approved' ? 'selected' : '' }}>Approved</option>
                                                <option value="rejected" {{ $film->curation_status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="curator_note" class="form-control input-sm" rows="2" placeholder="Catatan kurator">{{ $film->curator_note }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-warning btn-xs">Simpan Kurasi</button>
                                    </form>
                                    @endif

                                    @if(in_array(auth()->user()->role, ['admin', 'adminsub', 'juri']) && $film->curation_status === 'approved')
                                    @php
                                    $myScore = $film->juryScores->firstWhere('jury_id', auth()->id());
                                    @endphp
                                    <form action="{{ route('review.jury-score', $film) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group">
                                            <input type="number" name="score" class="form-control input-sm"
                                                min="0" max="100" step="0.01"
                                                value="{{ old('score', optional($myScore)->score) }}"
                                                placeholder="Nilai juri">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="winner_rank" class="form-control input-sm"
                                                value="{{ old('winner_rank', $film->winner_rank) }}"
                                                placeholder="Contoh: Juara 1">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="note" class="form-control input-sm" rows="2" placeholder="Catatan juri">{{ old('note', optional($myScore)->note) }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-success btn-xs">Simpan Penilaian</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Belum ada submission.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

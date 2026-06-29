@extends('layouts.master')
@section('container')
@php
    $existingScores = optional($review)->scores ? $review->scores->keyBy('review_rubric_item_id') : collect();
@endphp
<section class="content-header">
    <h1>{{ $stageLabel }}: {{ $film->name }}</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $film->category->name ?? '-' }} / {{ $film->submissionSetting->name ?? '-' }}</h3>
                </div>
                <form method="POST" action="{{ route('review.score.update', [$film, $stage]) }}">
                    @csrf
                    @method('PATCH')
                    <div class="box-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul style="margin-bottom:0;">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @foreach($rubric->groups as $group)
                        <div style="border:1px solid #d2d6de; padding:15px; margin-bottom:15px;">
                            <h4 style="margin-top:0;">
                                {{ $group->title }}
                                @if($group->weight !== null)
                                <small>Bobot {{ number_format((float) $group->weight, 2) }}</small>
                                @endif
                            </h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width:24%;">Sub-Aspek</th>
                                            <th>Indikator</th>
                                            <th style="width:12%;">Bobot</th>
                                            <th style="width:14%;">Skor 1-10</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($group->items as $item)
                                        @php
                                            $savedScore = optional($existingScores->get($item->id))->score;
                                        @endphp
                                        <tr>
                                            <td><strong>{{ $item->title }}</strong></td>
                                            <td>{{ $item->description ?: '-' }}</td>
                                            <td>{{ number_format((float) $item->weight, 2) }}</td>
                                            <td>
                                                <input type="number" class="form-control" name="scores[{{ $item->id }}]"
                                                    min="1" max="10" step="0.01" required
                                                    value="{{ old('scores.' . $item->id, $savedScore) }}">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endforeach

                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea name="note" class="form-control" rows="4">{{ old('note', optional($review)->note) }}</textarea>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('review.index', ['submission_setting_id' => $film->submission_setting_id, 'category_id' => $film->category_id, 'stage' => $stage]) }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Penilaian</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

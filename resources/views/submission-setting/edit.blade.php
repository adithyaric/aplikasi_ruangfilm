@extends('layouts.master')
@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Edit Periode Submission</b></h3>
                </div>
                <form action="{{ route('settingUpdate', $submissionSetting) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group">
                            <label>Nama Periode</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $submissionSetting->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Waktu Buka</label>
                            <input type="datetime-local" name="open_at" class="form-control"
                                value="{{ old('open_at', $submissionSetting->open_at->format('Y-m-d\TH:i')) }}" required>
                        </div>
                        <div class="form-group">
                            <label>Waktu Tutup</label>
                            <input type="datetime-local" name="close_at" class="form-control"
                                value="{{ old('close_at', $submissionSetting->close_at->format('Y-m-d\TH:i')) }}" required>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('settingIndex') }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

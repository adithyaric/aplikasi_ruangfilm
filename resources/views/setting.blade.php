@extends('layouts.master')
@section('container')
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Setting Batas Submission</b></h3>
                </div>

                @if(session('success'))
                <div class="alert alert-success" style="margin:16px 16px 0;">
                    {{ session('success') }}
                </div>
                @endif

                {{-- Preview Status Saat Ini --}}
                <div style="margin:16px 16px 0;">
                    @php
                    $submissionOpen = \App\Models\SubmissionSetting::isOpen();
                    @endphp

                    @if(!$setting)
                    {{-- Setting belum diatur oleh admin --}}
                    <div class="alert alert-warning">
                        <i class="fa fa-exclamation-triangle"></i>
                        <strong>Perhatian!</strong> Jadwal submission belum diatur. Peserta tidak dapat melakukan submission sampai jadwal ditentukan.
                    </div>
                    @elseif($submissionOpen)
                    <div class="alert alert-success">
                        <i class="fa fa-check-circle"></i>
                        <strong>Submission Sedang Berlangsung.</strong>
                        Dibuka sejak <strong>{{ $setting->open_at->translatedFormat('d F Y, H:i') }} WIB</strong>
                        dan akan ditutup pada <strong>{{ $setting->close_at->translatedFormat('d F Y, H:i') }} WIB</strong>
                        ({{ now()->diffForHumans($setting->close_at, true) }} lagi).
                    </div>
                    @elseif(now()->lessThan($setting->open_at))
                    <div class="alert alert-info">
                        <i class="fa fa-clock-o"></i>
                        <strong>Submission Belum Dibuka.</strong>
                        Akan dibuka pada <strong>{{ $setting->open_at->translatedFormat('d F Y, H:i') }} WIB</strong>
                        ({{ now()->diffForHumans($setting->open_at, true) }} lagi).
                    </div>
                    @else
                    <div class="alert alert-danger">
                        <i class="fa fa-lock"></i>
                        <strong>Submission Telah Ditutup.</strong>
                        Ditutup sejak <strong>{{ $setting->close_at->translatedFormat('d F Y, H:i') }} WIB</strong>.
                        Perbarui jadwal jika ingin membuka kembali.
                    </div>
                    @endif
                </div>

                <form action="{{ route('settingStore') }}" method="POST">
                    @csrf
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

                        <h5 style="font-weight:700; border-left:3px solid #1db9a0; padding-left:10px; margin:0 0 16px;">
                            Waktu Pembukaan Submission
                        </h5>
                        <div class="form-group">
                            <label>Opening Date & Time <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="open_at" class="form-control"
                                value="{{ old('open_at', $setting ? $setting->open_at->format('Y-m-d\TH:i') : '') }}"
                                required>
                        </div>

                        <h5 style="font-weight:700; border-left:3px solid #e53935; padding-left:10px; margin:20px 0 16px;">
                            Waktu Penutupan Submission
                        </h5>
                        <div class="form-group">
                            <label>Closing Date & Time <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="close_at" class="form-control"
                                value="{{ old('close_at', $setting ? $setting->close_at->format('Y-m-d\TH:i') : '') }}"
                                required>
                        </div>

                        <div style="background:#f8f9fa; border-radius:8px; padding:12px 16px; font-size:13px; color:#555;">
                            <i class="fa fa-info-circle"></i>
                            Submission hanya bisa dilakukan antara waktu pembukaan hingga penutupan yang ditentukan.
                        </div>

                    </div>

                    <div class="box-footer">
                        <a href="{{ route('dashboard') }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Setting</button>
                        <!-- @if($setting)
                        <form action="{{ route('settingDestroy') }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus jadwal submission? Peserta tidak akan bisa melakukan submission.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash"></i> Hapus Jadwal
                            </button>
                        </form>
                        @endif -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
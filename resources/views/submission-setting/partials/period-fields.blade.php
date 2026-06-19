@php
    $submissionSettingForm = $submissionSettingForm ?? null;
@endphp

<div class="form-group">
    <label>Nama Periode</label>
    <input type="text" name="name" class="form-control"
        value="{{ old('name', optional($submissionSettingForm)->name) }}"
        placeholder="Contoh: Submission Juli 2026" required>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Waktu Buka</label>
            <input type="datetime-local" name="open_at" class="form-control"
                value="{{ old('open_at', optional(optional($submissionSettingForm)->open_at)->format('Y-m-d\TH:i')) }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Waktu Tutup</label>
            <input type="datetime-local" name="close_at" class="form-control"
                value="{{ old('close_at', optional(optional($submissionSettingForm)->close_at)->format('Y-m-d\TH:i')) }}" required>
        </div>
    </div>
</div>

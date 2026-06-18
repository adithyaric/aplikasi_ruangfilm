@extends('layouts.master')
@section('container')
<section class="content-header">
    <h1>Data Expedisi</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{ route('expeditions.create') }}" class="btn btn-success">Tambah</a>
                </div>
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Layanan</th>
                                <th>Biaya</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($expeditions as $expedition)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $expedition->name }}</td>
                                <td>{{ $expedition->service_name ?? '-' }}</td>
                                <td>@currency($expedition->fee)</td>
                                <td>{{ $expedition->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                                <td>
                                    <a href="{{ route('expeditions.edit', $expedition) }}" class="btn btn-warning btn-xs">Edit</a>
                                    <form action="{{ route('expeditions.destroy', $expedition) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Hapus expedisi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
                                    </form>
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

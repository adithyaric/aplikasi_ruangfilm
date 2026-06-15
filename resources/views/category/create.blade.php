@extends('layouts.master')
@section('container')
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Kategori Film</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Kategori</label>
                            <input required type="text" class="form-control" name="name"
                                placeholder="Masukkan Nama Kategori">
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <a href="{{ route('categories.index') }}" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>
@endsection
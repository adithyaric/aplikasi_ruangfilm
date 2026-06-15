@extends('layouts.master')
@section('container')
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah User</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input required type="text" class="form-control" name="name"
                                placeholder="Masukkan Nama">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input required type="email" class="form-control" name="email"
                                placeholder="Masukkan Email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input required type="password" class="form-control" name="password"
                                placeholder="Masukkan Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Role</label>
                            <select name="role" class="form-control">
                                <option value="1" selected disabled>Pilih Role User</option>
                                <option value="admin">Superadmin</option>
                                <option value="adminsub">Admin Submission</option>
                                <option value="kurator">Kurator</option>
                                <option value="juri">Juri</option>
                            </select>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <a href="javascript:history.back()" class="btn btn-default">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
</section>
@endsection
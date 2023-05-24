@extends('admin.layouts.main')
@section('title', 'Ubah Password')

@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Data Petugas | {{ Auth::user()->name }}</h6>
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary" style="display: inline;">
                                    Data @yield("title")
                                </h6>
                                <div style="display: inline; float: right;">
                                    <div class="mt-2 text-end">
                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalGantiPassword" class="btn btn-primary fw-bold rounded-pill px-4 shadow btn-sm">Ganti Password</a>
                                    </div>
                                </div>
                            </div>
                            <form action="" method="POST">
                                @method("PUT")
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="mb-3 row">
                                            <label for="username" class="form-label col-md-3 text-right"> Username   </label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Nama" value="{{ Auth::user()->username }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="mb-3 row">
                                            <label for="name" class="form-label col-md-3 text-right"> Nama   </label>
                                            <div class="col-md-7">
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama" value="{{ Auth::user()->name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="mb-3 row">
                                            <label for="email" class="form-label col-md-3 text-right"> Email   </label>
                                            <div class="col-md-7">
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Masukkan Email" value="{{ Auth::user()->email }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer d-md-block">
                                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                                        <button type="button" class="btn btn-danger btn-sm">Batal</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalGantiPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-edit"></i> Edit Password
                </h5>
            </div>
            <form action="" method="POST">
                @method("PUT")
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password_lama" class="form-label"> Password Lama </label>
                        <input type="password" class="form-control" name="password_lama" id="password_lama" placeholder="Masukkan Password Lama">
                    </div>
                    <div class="form-group">
                        <label for="password_baru" class="form-label"> Password Baru </label>
                        <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Masukkan Password Baru">
                    </div>
                    <div class="form-group">
                        <label for="konfirmasi_password" class="form-label"> Konfirmasi Password </label>
                        <input type="password" class="form-control" name="konfirmasi_password" id="konfirmasi_password" placeholder="Masukkan Konfirmasi Password">
                    </div>
                </div>
                <div class="modal-footer d-md-block">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    <button type="button" class="btn btn-danger btn-sm">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

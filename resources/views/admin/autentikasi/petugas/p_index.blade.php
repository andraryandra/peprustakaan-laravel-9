@extends('admin.layouts.main')
@section('title', 'Petugas')

@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Table</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Petugas</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Data Petugas</h6>
                    <div class="col-12 text-end">
                        <div class="mt-2 text-end">
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalTambah" class="btn btn-primary fw-bold rounded-pill px-4 shadow btn-sm">Tambah +</a>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        @if (session('berhasil'))
                            <div class="alert alert-success">
                                {{ session('berhasil')}}
                            </div>
                        @endif
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Nama</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($petugas as $data)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td style="size: 20px;">
                                            <div class="row">
                                                <div class="col-md-8 text-end">
                                                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$data->id}}">
                                                        Detail
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Form Tambah -->
<div class="modal fade" id="exampleModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 40%">
        <div class="modal-content">
            <div class="modal-header hader">
                <h3 class="modal-title" id="exampleModalLabel">
                    Tambah Petugas
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="nama">Nama</label>
                                <input type="text" name="name" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan nama">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="username">Username</label>
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan username">
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password">
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                </div>

                <div class="modal-footer d-md-block">
                    <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                    <button type="button" class="btn btn-danger btn-sm">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END -->

<!-- Form Deatil -->
<div class="modal fade" id="exampleModalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 40%">
        <div class="modal-content">
            <div class="modal-header hader">
                <h3 class="modal-title" id="exampleModalLabel">
                    Detail Petugas
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modal-content-detail">

            </div>
            <div class="modal-footer d-md-block">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" aria-label="Close">Kembali</button>
            </div>
        </div>
    </div>
</div>

@foreach ($petugas as $data)
    <div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 40%">
            <div class="modal-content">
                <div class="modal-header hader">
                    <h2 class="modal-title" id="exampleModalLabel">Data Petugas</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-content-detail">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="username" class="col-sm-2 col-form-label text-right">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" value="{{ $data->username }}" readonly>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label text-right">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" value="{{ $data->name }}" readonly>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label text-right"> Email </label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email" value="{{ $data->email }}" readonly>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer d-md-block">
                        <button type="button" class="btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection

@section('js')

<script src="{{ url('') }}/assets/admin/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="{{ url('') }}/assets/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
<script src="{{ url('') }}/assets/admin/js/data-table.js"></script>

@endsection

@extends('admin.layouts.main')
@section('title', 'Anggota')

@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Table</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data Anggota</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Data Anggota</h6>
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
                                    <th class="text-center">Foto</th>
                                    <th class="text-center">NIS</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Jabatan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggota as $data)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $data->name }}</td>
                                        <td class="text-center"><img src="{{ url('/storage/' .$data->photo)}}" class="wd-100 ht-100 rounded-circle"></td>
                                        <td class="text-center">{{ $data->username }}</td>
                                        <td class="text-center">{{ $data->email }}</td>
                                        <td class="text-center">{{ $data->keterangan }}</td>
                                        <td class="text-center">
                                            {{-- <span class="badge badge-danger" style="background-color: orange;">
                                                Tidak Aktif
                                            </span> --}}
                                            <span class="badge badge-danger" style="background-color: green;">
                                                Aktif
                                            </span>
                                        </td>
                                        <td style="size: 20px;">
                                            <div class="row">
                                                <div class="col-md-3 text-end">
                                                    <button onclick="editAnggota({{ $data->id }})" type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalEdit">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-3 text-end">
                                                    <button onclick="" type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalDetail">
                                                        <i class="bi bi-list"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-3 text-end">
                                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-sm" type="submit">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
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
    <div class="modal-dialog modal-lg" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header hader">
                <h3 class="modal-title" id="exampleModalLabel">
                    Tambah Anggota
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="photo"> Foto </label>
                                <input type="file" class="form-control" name="photo" id="photo">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="email">Email</label>
                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="nama">Nama</label>
                                <input type="text" name="name" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan nama">
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="username">NIS</label>
                                <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan username">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="alamat">Alamat</label>
                                <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat">
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label>Keterangan</label>
                                <div>
                                    <select class="form-control mb-3" name="keterangan">
                                        <option>-- Pilih saja --</option>
                                        <option value="TU">TU</option>
                                        <option value="Siswa">Siswa</option>
                                    </select>
                                    @error('keterangan')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
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

<!-- Form Edit -->
<div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header hader">
                <h3 class="modal-title" id="exampleModalLabel">
                    Edit Anggota
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ url("/admin/autentikasi/anggota") }}" method="POST">
                @method("PUT")
                {{ csrf_field() }}
                <div class="modal-body" id="modal-content-edit">
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

@section('js')

<script src="{{ url('') }}/assets/admin/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="{{ url('') }}/assets/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
<script src="{{ url('') }}/assets/admin/js/data-table.js"></script>
<script type="text/javascript">
    function editAnggota(id) {
        $.ajax({
            url: "{{ url('/admin/autentikasi/anggota/edit') }}",
            type: "GET",
            data: {
                id: id
            },
            success: function(data) {
                $("#modal-content-edit").html(data);
                return true
            }
        })
    }
</script>
@endsection

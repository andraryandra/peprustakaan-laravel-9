@extends('admin.layouts.main')
@section('title', 'Verifikasi Buku')

@section('content')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Table</a></li>
            <li class="breadcrumb-item active" aria-current="page">Verifikasi Buku</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Verifikasi Buku</h6>
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
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Judul Ebook</th>
                                    <th class="text-center">File</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="text-center">Felisa</td>
                                    <td class="text-center">Menari Ketawa</td>
                                    <td class="text-center"><i class="link-icon" data-feather="file-text"></i></td>
                                    <td class="text-center">
                                        {{-- <span class="badge badge-danger" style="background-color: orange;">
                                            Tidak Aktif
                                        </span> --}}
                                        <span class="badge badge-danger" style="background-color: green;">
                                            Terima
                                        </span>
                                        {{-- <span class="badge badge-danger" style="background-color: red;">
                                            Ditolak
                                        </span> --}}
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalDetail"
                                            class="btndetail">
                                            <i class="bi bi-list"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">2</td>
                                    <td class="text-center">Rahmawati</td>
                                    <td class="text-center">Ketawa</td>
                                    <td class="text-center"><i class="link-icon" data-feather="file-text"></i></td>
                                    <td class="text-center">
                                        {{-- <span class="badge badge-danger" style="background-color: orange;">
                                            Tidak Aktif
                                        </span> --}}
                                        {{-- <span class="badge badge-danger" style="background-color: green;">
                                            Terima
                                        </span> --}}
                                        <span class="badge badge-danger" style="background-color: red;">
                                            Ditolak
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalDetail"
                                            class="btndetail">
                                            <i class="bi bi-list"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">3</td>
                                    <td class="text-center">Haikal</td>
                                    <td class="text-center">Berguling</td>
                                    <td class="text-center"><i class="link-icon" data-feather="file-text"></i></td>
                                    <td class="text-center">
                                        <span class="badge badge-danger" style="background-color: orange;">
                                            Proses
                                        </span>
                                        {{-- <span class="badge badge-danger" style="background-color: green;">
                                            Terima
                                        </span> --}}
                                        {{-- <span class="badge badge-danger" style="background-color: red;">
                                            Ditolak
                                        </span> --}}
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalDetail"
                                            class="btndetail">
                                            <i class="bi bi-list"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">4</td>
                                    <td class="text-center">Aziz</td>
                                    <td class="text-center">Terjun</td>
                                    <td class="text-center"><i class="link-icon" data-feather="file-text"></i></td>
                                    <td class="text-center">
                                        <span class="badge badge-danger" style="background-color: orange;">
                                           Proses
                                        </span>
                                        {{-- <span class="badge badge-danger" style="background-color: green;">
                                            Terima
                                        </span> --}}
                                        {{-- <span class="badge badge-danger" style="background-color: red;">
                                            Ditolak
                                        </span> --}}
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalDetail"
                                            class="btndetail">
                                            <i class="bi bi-list"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">5</td>
                                    <td class="text-center">Ryan</td>
                                    <td class="text-center">Bahagia</td>
                                    <td class="text-center"><i class="link-icon" data-feather="file-text"></i></td>
                                    <td class="text-center">
                                        <span class="badge badge-danger" style="background-color: orange;">
                                            Proses
                                        </span>
                                        {{-- <span class="badge badge-danger" style="background-color: green;">
                                            Terima
                                        </span> --}}
                                        {{-- <span class="badge badge-danger" style="background-color: red;">
                                            Ditolak
                                        </span> --}}
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalDetail"
                                            class="btndetail">
                                            <i class="bi bi-list"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 30%">
        <div class="modal-content">
            <div class="modal-header hader">
                <h5 class="modal-title" id="exampleModalLabel">
                    Detail Verifikasi Ebook
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body" id="modal-content-detail">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="nama">Username</label>
                                <input type="nama" name="name" class="form-control @error('name') is-invalid @enderror" value="Felisa">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="nama">Judul</label>
                                <input type="nama" name="name" class="form-control @error('name') is-invalid @enderror" value="Felisa">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <p class="text-center">
                                <b>File Buku</b>
                            </p>
                            <p class="text-center mt-3">
                                <i class="link-icon" data-feather="file-text"></i>
                            </p>
                        </div>
                    </div>

                    {{-- <br> --}}
                    <div class="row">
                        <div class="col-md-6 text-end">
                            <button type="button" class="btn btn-success mt-4 end" data-bs-toggle="modal" data-bs-target="#verifikasi-">
                                <i class="link-icon" data-feather="check"></i>
                                Verifikasi
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-danger mt-4 end" data-bs-toggle="modal" data-bs-target="#tolak-">
                                <i class="link-icon" data-feather="x"></i>
                                Tolak
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Verifikasi --}}
{{-- @foreach ($user as $pengguna) --}}
<div class="modal fade" id="verifikasi-" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:30%">
        <div class="modal-content">
            <h4 class="modal-title text-center" id="exampleModalLabel">Verifikasi Buku</h4>
            <div class="modal-body" id="modal-content-detail">
                <form action="" method="POST">
                    @method("PUT")
                    @csrf
                    <div class="card-body text-center">
                        <p>
                            <b>
                                Yakin Verifikasi Buku Menari Ketawa?
                            </b>
                        </p><br>
                        <button type="submit" class="btn btn-success btn-sm" >
                            Verifikasi
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalDetail" aria-label="Close">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- @endforeach --}}
{{-- End --}}

{{-- Tolak --}}
{{-- @foreach ($user as $pengguna) --}}
<div class="modal fade" id="tolak-" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width:30%">
        <div class="modal-content">
            <h4 class="modal-title text-center" id="exampleModalLabel">Konfirmasi Tolak Buku</h4>
            <div class="modal-body" id="modal-content-detail">
                <form action="" method="POST">
                    @method("PUT")
                    @csrf
                    <div class="card-body text-center">
                        <p>
                            <b>
                                Alasan Menolak Buku Menari Ketawa ?
                            </b>
                        </p>
                        <textarea name="" id="" cols="35" rows="10" placeholder="Alasan"></textarea>
                        <br>
                        <button type="submit" class="btn btn-success btn-sm">
                            Simpan
                        </button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalDetail" aria-label="Close">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- @endforeach --}}
{{-- End --}}
@endsection

@section('js')

<script src="{{ url('') }}/assets/admin/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="{{ url('') }}/assets/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
<script src="{{ url('') }}/assets/admin/js/data-table.js"></script>
<script type="text/javascript">

</script>
@endsection

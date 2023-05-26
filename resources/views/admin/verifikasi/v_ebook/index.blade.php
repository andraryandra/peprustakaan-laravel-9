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
                                    {{ session('berhasil') }}
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
                                    @foreach ($data_ebook as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center text-capitalize">{{ $item->user->name }}</td>
                                            <td class="text-center text-capitalize">{{ $item->judul_buku }}</td>
                                            <td class="text-center">
                                                <a href="{{ Storage::url($item->file) }}" target="__blank">
                                                    <i class="link-icon" data-feather="file-text"></i>
                                                </a>
                                            </td>
                                            @foreach ($item->ebook_item_verify as $item2)
                                                <td class="text-center">
                                                    @if ($item2->verifikasi_ebook == 'ACTIVE')
                                                        <span class="badge rounded-pill bg-success">Diterima</span>
                                                    @elseif($item2->verifikasi_ebook == 'INACTIVE')
                                                        <span class="badge rounded-pill bg-danger">Ditolak</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-warning">PENDING</span>
                                                    @endif
                                                </td>
                                            @endforeach
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a class="btn btn-primary mx-2" data-bs-toggle="modal"
                                                        href="#exampleModalEdit{{ $item->id }}" role="button"><i
                                                            class="bi bi-pencil-square"></i>
                                                        Verifikasi
                                                    </a>
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


    @include('admin.verifikasi.v_ebook.edit')

    <div class="modal fade" id="exampleModalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 30%">
            <div class="modal-content">
                <div class="modal-header hader">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Detail Verifikasi Ebook
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('verifikasiEbook.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body" id="modal-content-detail">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="nama">Username</label>
                                        <input type="nama" name="name"
                                            class="form-control @error('name') is-invalid @enderror" value="Felisa">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="nama">Judul</label>
                                        <input type="nama" name="name"
                                            class="form-control @error('name') is-invalid @enderror" value="Felisa">
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
                                    <button type="button" class="btn btn-success mt-4 end" data-bs-toggle="modal"
                                        data-bs-target="#verifikasi-">
                                        <i class="link-icon" data-feather="check"></i>
                                        Verifikasi
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-danger mt-4 end" data-bs-toggle="modal"
                                        data-bs-target="#tolak-">
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

@endsection

@section('js')

    <script src="{{ url('') }}/assets/admin/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{ url('') }}/assets/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
    <script src="{{ url('') }}/assets/admin/js/data-table.js"></script>
    <script type="text/javascript"></script>
@endsection

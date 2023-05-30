@extends('admin.layouts.main')
@section('title', 'Verifikasi Mading')

@section('madingVerifikasi')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Table</a></li>
                <li class="breadcrumb-item active" aria-current="page">Verifikasi Mading</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Verifikasi Mading</h6>
                        <br>
                        <div class="table-responsive">
                            @if (session('berhasil'))
                                <div class="alert alert-success">
                                    {{ session('berhasil') }}
                                </div>
                            @elseif (session('gagal'))
                                <div class="alert alert-danger">
                                    {{ session('gagal') }}
                                </div>
                            @endif
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Judul Mading</th>
                                        <th class="text-center">Tags</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Pesan</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_mading as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $item->user->name }}</td>
                                            {{-- <td class="text-center">
                                                <img src="{{ Storage::url($item->image) }}" style="width: 50%;">
                                            </td> --}}
                                            <td class="text-center">{{ $item->judul }}</td>
                                            <td class="text-center">
                                                @php
                                                    $tags = json_decode($item->tags);
                                                @endphp
                                                @foreach ($tags as $tag)
                                                    <span class="badge bg-info p-2">{{ $tag->value }}</span>
                                                @endforeach
                                            </td>
                                            @foreach ($item->mading_items as $item2)
                                                <td class="text-center">
                                                    @if ($item2->verifikasi_mading == 'ACTIVE')
                                                        <span class="badge rounded-pill bg-success">Diterima</span>
                                                    @elseif($item2->verifikasi_mading == 'INACTIVE')
                                                        <span class="badge rounded-pill bg-danger">Ditolak</span>
                                                    @else
                                                        <span class="badge rounded-pill bg-warning">PENDING</span>
                                                    @endif
                                                </td>
                                            @endforeach
                                            @foreach ($item->mading_items as $item2)
                                                <td class="text-center">
                                                    @if ($item2->description == null)
                                                        <span class="badge rounded-pill bg-warning">Tidak Ada Pesan</span>
                                                    @else
                                                        {{ $item2->description }}
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

    @include('admin.verifikasi.v_mading.edit')

    <div class="modal fade" id="exampleModalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 60%">
            <div class="modal-content">
                <div class="modal-header hader text-center">
                    <h3 class="modal-title" id="exampleModalLabel">Detail </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-content-detail">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>
                                    Nama Lengkap
                                </h5>



                                <h5 class="mt-4">
                                    Username
                                </h5>



                                <h5 class="mt-4">
                                    Email
                                </h5>


                            </div>

                            <div class="col-md-6">
                                <h5>
                                    No KTP
                                </h5>



                                <h5 class="mt-4">
                                    Tempat, Tanggal Lahir
                                </h5>


                            </div>

                            <div class="col-md-12">
                                <p class="text-center">
                                    <b>Link google drive</b>
                                </p>
                                <p class="text-center">

                                </p>
                            </div>
                        </div>

                        {{-- <br> --}}
                        <div class="row">
                            <div class="col-md-6 text-end">
                                <button type="button" class="btn btn-success mt-4 end" data-bs-toggle="modal"
                                    data-bs-target="#verifikasi-">
                                    Verifikasi
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-danger mt-4 end" data-bs-toggle="modal"
                                    data-bs-target="#tolak-">
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
                <h4 class="modal-title text-center" id="exampleModalLabel">Verifikasi Pengguna</h4>
                <div class="modal-body" id="modal-content-detail">
                    <form action="" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card-body text-center">
                            <p>
                                <b>
                                    Yakin Verifikasi Pengguna
                                </b>
                            </p>
                            <button type="submit" class="btn btn-success btn-sm">
                                Verifikasi
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#exampleModalDetail" aria-label="Close">Kembali</button>
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
                <h4 class="modal-title text-center" id="exampleModalLabel">Konfirmasi Tolak Pengguna</h4>
                <div class="modal-body" id="modal-content-detail">
                    <form action="" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card-body text-center">
                            <p>
                                <b>
                                    Alasan Menolak Pengguna ?
                                </b>
                            </p>
                            <textarea name="" id="" cols="30" rows="10" placeholder="Alasan"></textarea>
                            <br>
                            <button type="submit" class="btn btn-success btn-sm">
                                Simpan
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#exampleModalDetail" aria-label="Close">Kembali</button>
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

    <script src="{{ asset('assets/admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/admin/js/data-table.js') }}"></script>
@endsection

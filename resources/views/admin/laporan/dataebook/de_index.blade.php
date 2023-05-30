@extends('admin.layouts.main')
@section('title', 'Laporan Buku')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Laporan Buku</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
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
                            <div class="col-md-12">
                                <div class="card shadow mb-4">
                                    <!-- Button trigger modal -->
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            Export Custom Date Data @yield('title')
                                        </h6>
                                    </div>
                                    <div class="mx-3 my-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exportCustom">
                                            Export Laporan Buku Excel .CSV
                                        </button>
                                        <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal"
                                            data-bs-target="#pdfCustom">
                                            PDF Laporan Buku
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            Data @yield('title')
                                        </h6>
                                    </div>
                                    <div class="mt-3 mx-3">
                                        <button type="button" onclick="window.location.href='{{ route('export.mading') }}'"
                                            class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                                            <i class="btn-icon-prepend" data-feather="download"></i>
                                            Export to All Data Buku
                                        </button>

                                        <a href="{{ route('print.mading') }}" target="__blank"
                                            class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0"> <i
                                                class="btn-icon-prepend" data-feather="printer"></i>
                                            Print</a>
                                    </div>

                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTableExample" width="100%"
                                                cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Kategori</th>
                                                        <th class="text-center">Sub Kategori</th>
                                                        <th class="text-center">File</th>
                                                        <th class="text-center">Judul Buku</th>
                                                        <th class="text-center">Status Verifikasi</th>
                                                        <th class="text-center">Penulis</th>
                                                        <th class="text-center">Tahun Terbit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($ebook as $item)
                                                        <tr>
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td class="text-center">{{ $item->kategori->nama_kategori }}
                                                            </td>
                                                            <td class="text-center">{{ $item->subkategori->subkategori }}
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="{{ Storage::url($item->file) }}" target="__blank">
                                                                    <i class="link-icon" data-feather="file-text"></i>
                                                                </a>
                                                            </td>
                                                            <td class="text-center">{{ $item->judul_buku }}</td>
                                                            <td class="text-center">
                                                                @foreach ($item->ebook_item_verify as $item2)
                                                                    @if ($item2->verifikasi_ebook == 'ACTIVE')
                                                                        <span
                                                                            class="badge rounded-pill bg-success">Diterima</span>
                                                                    @elseif($item2->verifikasi_ebook == 'INACTIVE')
                                                                        <span
                                                                            class="badge rounded-pill bg-danger">Ditolak</span>
                                                                    @else
                                                                        <span
                                                                            class="badge rounded-pill bg-warning">PENDING</span>
                                                                    @endif
                                                                @endforeach
                                                            <td class="text-center">{{ $item->penulis }}</td>
                                                            <td class="text-center">{{ $item->tahun_terbit }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END Tabel -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal1 -->
    <div class="modal fade" id="exportCustom" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Export Excel .CSV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('exportCustom.mading') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="tanggal_mulai"> Tanggal Mulai </label>
                                    <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai"
                                        value="{{ empty($tanggal_mulai) ? '' : $tanggal_mulai }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_akhir"> Tanggal Akhir </label>
                                    <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir"
                                        value="{{ empty($tanggal_akhir) ? '' : $tanggal_akhir }}">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm"> Export CSV </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal2 -->
    <div class="modal fade" id="pdfCustom" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">PDF Laporan Mading</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('printCustom.mading') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="tanggal_mulai"> Tanggal Mulai </label>
                                    <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai"
                                        value="{{ empty($tanggal_mulai) ? '' : $tanggal_mulai }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal_akhir"> Tanggal Akhir </label>
                                    <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir"
                                        value="{{ empty($tanggal_akhir) ? '' : $tanggal_akhir }}">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-sm"> Export PDF </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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

@endsection

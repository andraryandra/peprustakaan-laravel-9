@extends('admin.layouts.main')
@section('title', 'Laporan Anggota')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Laporan</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Laporan Anggota</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="mt-2 text-end">
                            <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
                                <i class="btn-icon-prepend" data-feather="printer"></i>
                                Print
                            </button>
                        </div>
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
                                    <form action="" method="POST">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="tanggal_mulai"> Tanggal Mulai </label>
                                                    <input type="date" class="form-control" name="tanggal_mulai"
                                                        id="tanggal_mulai"
                                                        value="{{ empty($tanggal_mulai) ? '' : $tanggal_mulai }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="tanggal_akhir"> Tanggal Akhir </label>
                                                    <input type="date" class="form-control" name="tanggal_akhir"
                                                        id="tanggal_akhir"
                                                        value="{{ empty($tanggal_akhir) ? '' : $tanggal_akhir }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                Filter Data
                                            </button>
                                            <button type="reset" class="btn btn-danger btn-sm">
                                                Batal
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">
                                            Data @yield('title')
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTableExample" width="100%"
                                                cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">No.</th>
                                                        <th class="text-center">Nama</th>
                                                        <th class="text-center">Status User</th>
                                                        <th class="text-center">Tanggal</th>
                                                        {{-- <th class="text-center">Aksi</th> --}}
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users as $item)
                                                        <tr>
                                                            <td class="text-center">{{ $loop->iteration }}</td>
                                                            <td class="text-center">{{ $item->name }}</td>
                                                            <td class="text-center">{{ $item->status }}</td>
                                                            <td class="text-center">{{ $item->created_at }}</td>
                                                            {{-- <td class="text-center">{{ $item-> }}</td> --}}
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

@endsection

@section('js')

    <script src="{{ url('') }}/assets/admin/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{ url('') }}/assets/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
    <script src="{{ url('') }}/assets/admin/js/data-table.js"></script>

@endsection

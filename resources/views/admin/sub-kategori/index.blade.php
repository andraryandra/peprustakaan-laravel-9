@extends('admin.layouts.main')
@section('title', 'Sub Kategori')

@section('subKategori')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Table</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Sub Kategori</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Data Sub Kategori</h6>
                        <div class="col-12 text-end">
                            <div class="mt-2 text-end">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalTambah"
                                    class="btn btn-primary fw-bold rounded-pill px-4 shadow btn-sm">Tambah +</a>
                            </div>
                        </div>
                        <br>
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
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Nama Sub Kategori</th>
                                        <th class="text-center">Slug</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sub_kategori as $subkategori)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $subkategori->kategori->nama_kategori }}</td>
                                            <td class="text-center">{{ $subkategori->subkategori }}</td>
                                            <td class="text-center">{{ $subkategori->slug }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <a class="btn btn-primary mx-2" data-bs-toggle="modal"
                                                        href="#exampleModalEdit{{ $subkategori->id }}" role="button"><i
                                                            class="bi bi-pencil-square"></i>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('sub-kategori.destroy', $subkategori->id) }}"
                                                        method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger me-2"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                            <i class="bi bi-trash"></i> Hapus
                                                        </button>
                                                    </form>
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

    @include('admin.sub-kategori.edit')

    <!-- Form Tambah -->
    <div class="modal fade" id="exampleModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 40%">
            <div class="modal-content">
                <div class="modal-header hader">
                    <h3 class="modal-title" id="exampleModalLabel">
                        Tambah Sub Kategori
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label>Kategori</label>
                            <div>
                                <select class="form-select" name="kategori_id" id="kategori_id">
                                    <option value="">-- Pilih --</option>
                                    @foreach ($kategori as $sdata)
                                        <option value="{{ $sdata->id }}">{{ $sdata->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Nama Sub Kategori</label>
                            <input type="text" name="subkategori"
                                class="form-control @error('subkategori') is-invalid @enderror"
                                placeholder="Masukkan nama sub kategori" aria-describedby="basic-addon1">
                            @error('subkategori')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer d-md-block">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- END -->

@endsection

@section('js')

    <script src="{{ asset('assets/admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/admin/js/data-table.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('option[value=""]').css('display', 'none');
        });
    </script>
@endsection

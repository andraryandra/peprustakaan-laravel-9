@extends('admin.layouts.main')
@section('title', 'Buku')

@section('ebook')

    <div class="page-content">
        <div class="my-3">
            <button type="button" onclick="window.location.href='{{ route('buku.index') }}'"
                class="btn btn-primary">Kembali</button>
        </div>
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Table</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Buku</li>
            </ol>
        </nav>


        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Data Buku -- {{ $buku->judul_buku }}</h6>
                        <div class="col-12 text-end">
                            <div class="mt-2 text-end">
                                <a href="{{ route('isi-buku.isiCerita', $buku->id) }}" class="btn btn-primary"
                                    class="btn btn-primary fw-bold rounded-pill px-4 shadow btn-sm">Tambah +</a>
                            </div>
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
                            @endif
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">File</th>
                                        <th class="text-center">Judul Part</th>
                                        <th class="text-center">Isi Content</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($isi_buku as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-center">
                                                <a href="{{ Storage::url($item->file) }}" target="__blank">
                                                    <i class="link-icon" data-feather="file-text"></i>
                                                </a>
                                            </td>
                                            <td>{{ $item->judul_part }}</td>
                                            <td>{!! Illuminate\Support\Str::limit($item->content_part, 75) !!}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-primary me-2"
                                                        onclick="window.location.href='{{ route('buku-isi.edit', $item->id) }}'">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </button>
                                                    <form action="{{ route('buku-isi.destroy', $item->id) }}"
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

    <!-- Form Tambah -->
    <div class="modal fade" id="exampleModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 50%">
            <div class="modal-content">
                <div class="modal-header hader">
                    <h3 class="modal-title" id="exampleModalLabel">
                        Tambah Buku
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="user_id">Diposting Oleh</label>
                                    <div>
                                        <select class="form-select" name="user_id" id="user_id">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($users as $sdata)
                                                <option value="{{ $sdata->id }}">{{ $sdata->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="judul_buku">Judul Buku</label>
                                    <input type="text" name="judul_buku"
                                        class="form-control @error('judul_buku') is-invalid @enderror"
                                        placeholder="Tambahkan judul buku">
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="kategori">Kategori</label>
                                    <div>
                                        <select class="form-select" name="kategori_id" id="kategori_id">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($kategori as $sdata)
                                                <option value="{{ $sdata->id }}">{{ $sdata->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="subkategori">Sub Kategori</label>
                                    <div>
                                        <select class="form-select" name="subkategori_id" id="subkategori_id">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($subkategori as $sdata)
                                                <option value="{{ $sdata->id }}">{{ $sdata->subkategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="cover">Cover</label>
                                    <input type="file" name="cover" id="cover" class="form-control">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="file">File</label>
                                    <input type="file" name="file"
                                        class="form-control @error('file') is-invalid @enderror"
                                        placeholder="Tambahkan file">
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="penulis">Penulis</label>
                                    <input type="text" name="penulis" class="form-control"
                                        placeholder="Nama Penulis">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="tahun_terbit">Tahun Terbit</label>
                                    <input type="date" name="tahun_terbit" class="form-control"
                                        placeholder="Tahun Terbit">
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="sinopsis">Sinopsis</label>
                                    <textarea name="sinopsis" id="sinopsis" class="form-control" rows="5" placeholder="Tambahkan sinopsis"></textarea>
                                </div>
                            </div><!-- Col -->
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
    <!-- END -->

    <!-- Form Edit -->
    <div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 50%">
            <div class="modal-content">
                <div class="modal-header hader">
                    <h3 class="modal-title" id="exampleModalLabel">
                        Edit Buku
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ url('/admin/buku/simpan') }}" method="POST">
                    @method('PUT')
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

    <script src="{{ asset('assets/admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/admin/js/data-table.js') }}"></script>
    <script src="{{ url('https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#sinopsis'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script type="text/javascript">
        function editEbookbuku(id) {
            $.ajax({
                url: "{{ url('/admin/buku/{}/edit') }}",
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

    <script>
        $(document).ready(function() {
            // Menggunakan selector untuk memilih elemen option dengan value kosong
            $("option[value='']").hide();
        });
    </script>
@endsection

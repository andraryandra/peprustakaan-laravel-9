@extends('admin.layouts.main')
@section('title', 'Buku')

@section('ebook')
    <div class="page-content">
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
                        <h6 class="card-title">Data Buku</h6>
                        <div class="col-12 text-end">
                            <div class="mt-2 text-end">
                                <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalTambah"
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
                                        <th class="text-center">Id Buku</th>
                                        <th class="text-center">Cover</th>
                                        <th class="text-center">File</th>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Sub Kategori</th>
                                        <th class="text-center">Judul</th>
                                        {{-- <th class="text-center">Sinopsis</th> --}}
                                        <th class="text-center">Penulis</th>
                                        <th class="text-center">Diposting Oleh</th>
                                        <th class="text-center">Tahun Terbit</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($buku as $data)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $data->id }}</td>
                                            <td class="text-center"><img src="{{ Storage::url($data->cover) }}"
                                                    style="width: 50%;" style="height: 50%;"></td>
                                            <td class="text-center">
                                                <a href="{{ Storage::url($data->file) }}" target="__blank">
                                                    <i class="link-icon" data-feather="file-text"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">{{ $data->kategori->nama_kategori }}</td>
                                            <td class="text-center">{{ $data->subkategori->subkategori }}</td>
                                            <td class="text-center">{{ $data->judul_buku }}</td>
                                            {{-- <td class="text-center">{!! Illuminate\Support\Str::limit($data->sinopsis, 25) !!}</td> --}}
                                            <td class="text-center">{{ $data->user->name }}</td>
                                            <td class="text-center">{{ $data->penulis }}</td>
                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($data->tahun_terbit)->format('d/m/Y') }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-warning text-white me-2"
                                                        onclick="window.location.href='{{ route('buku-isi.show', $data->id) }}'">
                                                        <i class="bi bi-pencil-square"></i>
                                                        Isi Cerita
                                                    </button>
                                                    <button type="button" class="btn btn-primary me-2"
                                                        onclick="window.location.href='{{ route('buku.edit', $data->id) }}'">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </button>
                                                    <form action="{{ route('buku.destroy', $data->id) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger me-2"><i
                                                                class="bi bi-trash"></i> Hapus</button>
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
                            </div>
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

    <script src="{{ url('') }}/assets/admin/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{ url('') }}/assets/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
    <script src="{{ url('') }}/assets/admin/js/data-table.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
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

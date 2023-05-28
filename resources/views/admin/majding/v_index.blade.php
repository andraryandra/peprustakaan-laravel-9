@extends('admin.layouts.main')
@section('title', 'Mading')

@section('mading')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Table</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Mading</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Data Mading</h6>
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
                            @endif
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th class="text-center">Gambar</th>
                                        <th class="text-center">Content</th>
                                        <th class="text-center">Judul</th>
                                        <th class="text-center">Dibuat Oleh</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_mading as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center"><img src="{{ url('/storage/' . $item->image) }}"
                                                    style="width: 50%;"></td>
                                            <td class="text-center">
                                                {!! Illuminate\Support\Str::limit($item->content, 75) !!}
                                            </td>
                                            <td class="text-center">{{ $item->judul }}</td>
                                            {{-- <td class="text-center">{{ $item->buat }}</td> --}}
                                            <td class="text-center">{{ $item->user->name }}</td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-primary me-2"
                                                        onclick="window.location.href='{{ route('madjing.edit', $item->id) }}'">
                                                        <i class="bi bi-pencil-square"></i> Edit
                                                    </button>
                                                    <form action="{{ route('madjing.destroy', $item->id) }}" method="POST">
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

    {{-- Modal Tambah --}}
    <div class="modal fade" id="exampleModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 50%">
            <div class="modal-content">
                <div class="modal-header hader">
                    <h3 class="modal-title" id="exampleModalLabel">
                        Tambah Buku
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('madjing.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label class="user_id">Users</label>
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
                        <div class="form-group my-1">
                            <label for="image"> Gambar </label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                        <div class="form-group my-1">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" name="judul" id="judul"
                                placeholder="Masukkan judul" @error('judul') is-invalid @enderror
                                value="{{ old('judul') }}">
                            @error('judul')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group my-1">
                            <label for="content">Content</label>
                            <textarea name="content" id="content"></textarea>
                        </div>

                        <div class="form-group my-1">
                            <label for="tags">Tags</label>
                            <input type="text" class="form-control" name="tags" id="tags"
                                placeholder="Masukkan Tags" value="{{ old('tags') }}" style="display: none;">
                            <input type="text" class="form-control" name="hidden_tags" id="hidden_tags" readonly>
                            @error('tags')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
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


    {{-- @include('admin.majding.edit') --}}
@endsection

@push('style')
@endpush

@push('javascript')
    <script src="{{ url('') }}/assets/admin/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{ url('') }}/assets/admin/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
    <script src="{{ url('') }}/assets/admin/js/data-table.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        var input = document.querySelector('#tags');
        var hiddenInput = document.querySelector('#hidden_tags');
        var tagify = new Tagify(input);

        tagify.on('add', function(event) {
            var tags = tagify.value.map(tag => tag.value);
            hiddenInput.value = tags.join(', ');
        });

        tagify.on('remove', function(event) {
            var tags = tagify.value.map(tag => tag.value);
            hiddenInput.value = tags.join(', ');
        });
    </script>

    <script>
        $(document).ready(function() {
            // Menggunakan selector untuk memilih elemen option dengan value kosong
            $("option[value='']").hide();
        });
    </script>
@endpush

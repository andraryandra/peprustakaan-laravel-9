@extends('admin.layouts.main')
@section('title', 'Buku')

@section('ebook')

    <div class="page-content">
        <button type="button" class="btn btn-primary my-2 px-4"
            onclick="window.location.href='{{ route('buku.index') }}'">Back</button>
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Table</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Ebook</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Data Ebook</h6>
                        <div>
                            <form action="{{ route('buku.update', $buku->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="id" value="{{ $buku->id }}">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="user_id">Diposting Oleh</label>
                                        <div>
                                            <select class="form-select" name="user_id" id="user_id">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($users as $sdata)
                                                    <option value="{{ $sdata->id }}"
                                                        @if ($sdata->id == $buku->user_id) selected @endif>
                                                        {{ $sdata->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="form-group">
                                        <label for="judul_buku">Judul</label>
                                        <input type="text" name="judul_buku"
                                            class="form-control @error('judul_buku') is-invalid @enderror"
                                            placeholder="Tambahkan judul buku" value="{{ $buku->judul_buku }}">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="mb-3">
                                        <label class="kategori">Kategori</label>
                                        <div>
                                            <select class="form-select" name="kategori_id" id="kategori_id">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($kategori as $sdata)
                                                    <option value="{{ $sdata->id }}"
                                                        @if ($sdata->id == $buku->kategori_id) selected @endif>
                                                        {{ $sdata->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="mb-3">
                                        <label class="subkategori">Sub Kategori</label>
                                        <div>
                                            <select class="form-select" name="subkategori_id" id="subkategori_id">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($subkategori as $sdata)
                                                    <option value="{{ $sdata->id }}"
                                                        @if ($sdata->id == $buku->subkategori_id) selected @endif>
                                                        {{ $sdata->subkategori }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="mb-3">
                                        <label class="cover">Cover</label>
                                        <input type="file" name="cover" id="cover" class="form-control">
                                        <img src="{{ Storage::url($buku->cover) }}" class="my-3 rounded"
                                            style="width: 35%;">
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="file">File</label>
                                            <input type="file" name="file"
                                                class="form-control @error('file') is-invalid @enderror"
                                                placeholder="Tambahkan file">
                                            <p class="fst-italic">{{ $buku->file }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="penulis">Penulis</label>
                                            <input type="text" name="penulis" class="form-control"
                                                placeholder="Nama Penulis" value="{{ $buku->penulis }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="tahun_terbit">Tahun Terbit</label>
                                            <input type="date" name="tahun_terbit" class="form-control"
                                                placeholder="Tahun Terbit" value="{{ $buku->tahun_terbit }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="sinopsis">Sinopsis</label>
                                            <textarea name="sinopsis" id="sinopsis" value="{!! $buku->sinopsis !!}">{!! $buku->sinopsis !!}</textarea>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary mx-2 my-2">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('style')
@endpush

@push('javascript')
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

    <script>
        $(document).ready(function() {
            // Menggunakan selector untuk memilih elemen option dengan value kosong
            $("option[value='']").hide();
        });
    </script>
@endpush

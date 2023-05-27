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
        @if (session('berhasil'))
            <div class="alert alert-success">
                {{ session('berhasil') }}
            </div>
        @elseif (session('gagal'))
            <div class="alert alert-danger">
                {{ session('gagal') }}
        @endif
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Data Isi Content Ebook</h6>
                        <div>
                            <form action="{{ route('buku-isi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    {{-- <div class="" hidden> --}}
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="user_id">Diposting Oleh</label>
                                                <div>
                                                    <input type="text" name="user_id" class="form-control"
                                                        placeholder="User ID" value="{{ $buku->user_id }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- Row -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="kategori">Kategori</label>
                                                <div>
                                                    <input type="text" name="kategori_id" class="form-control"
                                                        placeholder="Kategori ID" value="{{ $buku->kategori_id }}" readonly>
                                                </div>
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="subkategori">Sub Kategori</label>
                                                <div>
                                                    <input type="text" name="subkategori_id" class="form-control"
                                                        placeholder="SubKategori ID" value="{{ $buku->subkategori_id }}"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="ebook_id">Ebook ID</label>
                                                <input type="text" name="ebook_id" class="form-control"
                                                    placeholder="Ebook ID" value="{{ $buku->id }}" readonly>
                                                </select>
                                            </div>
                                        </div>
                                    </div><!-- Row -->
                                    {{-- </div> --}}
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="judul_part">Judul Part</label>
                                                <input type="text" name="judul_part"
                                                    class="form-control @error('judul_part') is-invalid @enderror"
                                                    placeholder="Tambahkan judul part">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="content_part">Isi Cerita</label>
                                                <textarea name="content_part" id="content_part" class="form-control" rows="5"
                                                    placeholder="Tambahkan Content Ebook"></textarea>
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
            .create(document.querySelector('#content_part'))
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

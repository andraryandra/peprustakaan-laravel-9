@extends('admin.layouts.main')
@section('title', 'Mading')

@section('mading')

    <div class="page-content">
        <button type="button" class="btn btn-primary my-2 px-4"
            onclick="window.location.href='{{ route('anggota-mading.index') }}'">Back</button>
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Table</a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Mading</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Data Mading</h6>
                        <div>
                            <form action="{{ route('anggota-mading.update', $data_mading->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="id" value="{{ $data_mading->id }}">
                                <div class="row my-3">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Judul">Judul</label>
                                            <input type="text" class="form-control" name="judul" id="judul"
                                                value="{{ $data_mading->judul }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="user_id">Users</label>
                                            <select class="form-select" name="user_id" id="user_id">
                                                <option value="">-- Pilih --</option>
                                                @foreach ($users as $sdata)
                                                    <option value="{{ $sdata->id }}"
                                                        {{ $sdata->id == $data_mading->user_id ? 'selected' : '' }}>
                                                        {{ $sdata->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="image_new">Gambar</label>
                                            <br>
                                            <img src="{{ Storage::url($data_mading->image) }}" style="width: 35%;">
                                            <br><br>
                                            <input type="file" class="form-control" name="image" id="image_new">
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <textarea name="content" id="content" value="{!! $data_mading->content !!}">{!! $data_mading->content !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="tags">Tags</label>
                                            <input type="text" class="form-control" name="tags" id="tags"
                                                placeholder="Masukkan Tags" value="{{ $data_mading->tags }}"
                                                style="display: none;">
                                            <input type="text" class="form-control" name="hidden_tags" id="hidden_tags"
                                                value="{{ $data_mading->tags }}" readonly>
                                            @error('tags')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
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
        function initCKEditor(textareaId) {
            ClassicEditor
                .create(document.querySelector('#content' + textareaId))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        }
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

@foreach ($sub_kategori as $item)
    <div class="modal fade" id="exampleModalEdit{{ $item->id }}" tabindex="-1"
        aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 50%">
            <div class="modal-content">
                <div class="modal-header hader">
                    <h3 class="modal-title" id="exampleModalLabel{{ $item->id }}">
                        Edit Sub Kategori
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('sub-kategori.update', $item->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group mb-3">
                                <label>Kategori</label>
                                <div>
                                    <select class="form-select" name="kategori_id" id="kategori_id">
                                        <option value="">-- Pilih --</option>
                                        @foreach ($kategori as $sdata)
                                            <option value="{{ $sdata->id }}"
                                                @if ($sdata->id == $item->kategori_id) selected @endif>
                                                {{ $sdata->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nama Kategori</label>
                                <input type="text" name="subkategori" class="form-control"
                                    value="{{ $item->subkategori }}" required>
                                @error('subkategori')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-md-block">
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

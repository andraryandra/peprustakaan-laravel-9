<input type="hidden" name="id" value="{{ $edit->id }}">
<div class="form-group mb-3">
    <label>Kategori</label>
    <div>
        <select class="form-select" name="kategori_id" id="kategori_id">
            <option value="">-- Pilih --{{ $edit->kategori->kategori}}</option>
            @foreach ($kategori as $sdata)
             <option value="{{ $sdata->id }}">{{ $sdata->nama_kategori }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group">
    <label>Nama Kategori</label>
    <input type="text" name="subkategori" class="form-control" value="{{ $edit->subkategori }}" required>
    @error('subkategori')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>


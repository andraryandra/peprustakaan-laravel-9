<input type="hidden" name="id" value="{{ $edit->id }}">
<div class="form-group">
    <label>Nama Kategori</label>
    <input type="text" name="nama_kategori" class="form-control" value="{{ $edit->nama_kategori }}" required>
    @error('nama_kategori')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

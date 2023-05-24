<input type="hidden" name="id" value="{{ $edit->id }}">
<div class="form-group">
    <label for="image_new"> Gambar </label>
    <br><br>
    <img src="{{ url('/storage/' .$edit->image)}}" style="width: 35%;"><br><br>
    <input type="file" class="form-control" name="image" id="image_new">
</div>

<div class="form-group">
    <label for="Judul"> Judul </label>
    <input type="text" class="form-control" name="judul" id="judul" value="{{ $edit->judul }}">
</div>
<div class="form-group">
    <label for="buat"> Buat  </label>
    <input type="text" class="form-control" name="buat" id="buat" value="{{ $edit->buat }}">
</div>


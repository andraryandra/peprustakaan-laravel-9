<input type="hidden" name="id" value="{{ $edit->id }}">
<input type="hidden" name="gambarLama" value="{{ $edit->image }}">
<div class="form-group">
    <label for="image_new"> Gambar </label>
    <br><br>
    <img src="{{ url('/storage/' .$edit->image)}}" style="width: 35%;"><br><br>
    <input type="file" class="form-control" name="image" id="image_new">
</div>
<div class="form-group">
    <label for="teks1">Teks 1</label>
    <input type="text" class="form-control" name="teks1" id="teks1" value="{{ $edit->teks1 }}">
</div>
<div class="form-group">
    <label for="teks2">Teks 1</label>
    <input type="text" class="form-control" name="teks2" id="teks2" value="{{ $edit->teks2 }}">
</div>

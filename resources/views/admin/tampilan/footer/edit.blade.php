@foreach ($footer as $item)
    <div class="modal fade" id="exampleModalEdit{{ $item->id }}" tabindex="-1"
        aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 50%">
            <div class="modal-content">
                <div class="modal-header hader">
                    <h3 class="modal-title" id="exampleModalLabel{{ $item->id }}">
                        Edit Landing Page Footer
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('footer.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="image_new"> Gambar </label>
                            <br><br>
                            <img src="{{ Storage::url($item->image) }}" class="rounded shadow-sm"
                                style="width: 35%;"><br><br>
                            <input type="file" class="form-control" name="image" id="image_new">
                        </div>
                        <div class="form-group">
                            <label for="teks1">Teks 1</label>
                            <input type="text" class="form-control" name="teks1" id="teks1"
                                value="{{ $item->teks1 }}">
                        </div>
                        <div class="form-group">
                            <label for="teks2">Teks 1</label>
                            <textarea class="form-control" name="teks2" id="teks2" rows="3" value="{{ $item->teks2 }}">{{ $item->teks2 }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer d-md-block">
                        <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

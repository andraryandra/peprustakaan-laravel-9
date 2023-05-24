<input type="hidden" name="id" value="{{ $edit->id }}">
<div class="row">
    <div class="col-sm-6">
        <div class="mb-3">
            <label class="email">Email</label>
            <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $edit->email }}">
        </div>
    </div><!-- Col -->
    <div class="col-sm-6">
        <div class="mb-3">
            <label class="nama">Nama</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $edit->name }}">
        </div>
    </div><!-- Col -->
</div><!-- Row -->
<div class="row">
    <div class="col-sm-6">
        <div class="mb-3">
            <label class="username">NIS</label>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ $edit->username }}">
        </div>
    </div><!-- Col -->
    <div class="col-sm-6">
        <div class="mb-3">
            <label class="alamat">Alamat</label>
            <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ $edit->alamat }}">
        </div>
    </div><!-- Col -->
</div><!-- Row -->
<div class="row">
    <div class="col-sm-12">
        <div class="mb-3">
            <label>Keterangan</label>
            <div>
                <select class="form-control mb-3" name="keterangan">
                    <option>-- Pilih saja --</option>
                    <option value="TU">TU</option>
                    <option value="Siswa">Siswa</option>
                </select>
                @error('keterangan')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
    </div><!-- Col -->
    <div class="col-sm-12">
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan password">
        </div>
    </div><!-- Col -->
    <div class="col-sm-12">
        <div class="form-group">
            <label for="photo_new"> Foto </label>
            <br><br>
            <img src="{{ url('/storage/' .$edit->photo)}}" style="width: 25%;"><br><br>
            <input type="file" class="form-control" name="photo_new" id="photo_new">
        </div>
    </div>
</div><!-- Row -->

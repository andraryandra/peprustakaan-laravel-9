@foreach ($anggotas as $item)
    <div class="modal fade" id="exampleModalEdit{{ $item->id }}" tabindex="-1"
        aria-labelledby="exampleModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 50%">
            <div class="modal-content">
                <div class="modal-header hader">
                    <h3 class="modal-title" id="exampleModalLabel{{ $item->id }}">
                        Tambah Anggota
                    </h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('anggota.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 my-3">
                                <div class="form-group ">
                                    <label for="photo"> Foto </label>
                                    <input type="file" class="form-control" name="photo" id="photo">
                                    <img src="{{ Storage::url($item->photo) }}" alt="{{ $item->id }}" class="my-2"
                                        style="width: 35%;">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="email">Email</label>
                                    <input type="text" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Masukkan email" value="{{ $item->email }}">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="nama">Nama</label>
                                    <input type="text" name="name"
                                        class="form-control @error('nama') is-invalid @enderror"
                                        placeholder="Masukkan nama" value="{{ $item->name }}">
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="username">NIS</label>
                                    <input type="text" name="username"
                                        class="form-control @error('username') is-invalid @enderror"
                                        placeholder="Masukkan username" value="{{ $item->username }}">
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="alamat">Alamat</label>
                                    <input type="text" name="alamat"
                                        class="form-control @error('alamat') is-invalid @enderror"
                                        placeholder="Masukkan Alamat" value="{{ $item->alamat }}">
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label>Keterangan</label>
                                    <div>
                                        <select class="form-select mb-3" name="keterangan" required>
                                            <option>-- Pilih saja --</option>
                                            @if ($item->keterangan == 'TU')
                                                <option value="TU" selected>TU</option>
                                                <option value="SISWA">Siswa</option>
                                            @elseif($item->keterangan == 'SISWA')
                                                <option value="TU">TU</option>
                                                <option value="SISWA" selected>Siswa</option>
                                            @else
                                                <option value="TU">TU</option>
                                                <option value="SISWA">Siswa</option>
                                            @endif
                                        </select>
                                        @error('keterangan')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label>Level</label>
                                    <div>
                                        <select class="form-select mb-3" name="level">
                                            <option>-- Pilih saja --</option>
                                            @if ($item->level == 'petugas')
                                                <option value="0" selected>Petugas</option>
                                                <option value="1">Anggota</option>
                                            @elseif($item->level == 'anggota')
                                                <option value="0">Petugas</option>
                                                <option value="1" selected>Anggota</option>
                                            @else
                                                <option value="0">Petugas</option>
                                                <option value="1">Anggota</option>
                                            @endif
                                        </select>
                                        @error('level')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="d-flex align-items-center">
                                        <span class="text-danger">*</span>
                                        <p class="fst-italic ms-2 mb-0">Abaikan form password ini jika tidak ingin
                                            mengganti Password!</p>
                                    </div>
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Masukkan password">
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row -->
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

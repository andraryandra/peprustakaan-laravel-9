@foreach ($data_mading as $item)
    <div class="modal fade" id="exampleModalEdit{{ $item->id }}" aria-hidden="true"
        aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Detail Mading Verifikasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama-lengkap"
                                        value="{{ $item->user->name }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username"
                                        value="{{ $item->user->username }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email"
                                        value="{{ $item->user->email }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="no-ktp" class="form-label">No KTP</label>
                                    <input type="text" class="form-control" id="no-ktp" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="tempat-lahir" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="tempat-lahir"
                                        value="{{ $item->user->no_telp }}" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal-lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tanggal-lahir" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 text-end">
                                <button class="btn btn-success" data-bs-target="#exampleModalToggle2{{ $item->id }}"
                                    data-bs-toggle="modal">Verifikasi</button>
                            </div>
                            <div class="col-md-6">
                                <button class="btn btn-danger" data-bs-target="#exampleModalToggle3{{ $item->id }}"
                                    data-bs-toggle="modal">Tolak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Verifikasi --}}
    <div class="modal fade" id="exampleModalToggle2{{ $item->id }}" aria-hidden="true"
        aria-labelledby="exampleModalToggleLabel2{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalToggleLabel2{{ $item->id }}">Verifikasi Mading</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Yakin Verifikasi Mading?</h5>
                    <div class="row mt-3">
                        @foreach ($item->mading_items as $item2)
                            <form action="{{ route('verifikasiMading.update', $item2->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="mb-3" hidden>
                                    <input type="text" class="form-control" id="verifikasi_mading"
                                        name="verifikasi_mading" value="ACTIVE" readonly>
                                </div>
                                <div class="mb-3 form-floating" hidden>
                                    <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 text-end">
                                        <button class="btn btn-success ">Verifikasi</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-danger" type="button"
                                            data-bs-target="#exampleModalEdit{{ $item->id }}"
                                            data-bs-toggle="modal">Kembali</button>
                                    </div>
                                </div>
                            </form>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tolak --}}
    <div class="modal fade" id="exampleModalToggle3{{ $item->id }}" aria-hidden="true"
        aria-labelledby="exampleModalToggleLabel3{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title " id="exampleModalToggleLabel3{{ $item->id }}">Konfirmasi Tolak
                        Pengguna
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Alasan Menolak Pengguna ?</h5>
                    <div class="row mt-3">
                        @foreach ($item->mading_items as $item2)
                            <form action="{{ route('verifikasiMading.update', $item2->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="mb-3" hidden>
                                    <input type="text" class="form-control" id="verifikasi_mading"
                                        name="verifikasi_mading" value="INACTIVE" readonly>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="description" placeholder="Leave a comment here" id="floatingTextarea2"
                                        style="height: 100px" required></textarea>
                                    <label for="floatingTextarea2"></label>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 text-end">
                                        <button class="btn btn-success">Simpan</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-danger" type="button"
                                            data-bs-target="#exampleModalEdit{{ $item->id }}"
                                            data-bs-toggle="modal">Kembali</button>
                                    </div>
                                </div>
                            </form>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

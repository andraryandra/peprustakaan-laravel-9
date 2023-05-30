@extends('admin.layouts.main')
@section('title', 'Profile')

@section('content')
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Data</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Profile Petugas | {{ Auth::user()->name }}</h6>
                    </div>
                    <div class="main">
                        <div class="">
                            @if (session('berhasil'))
                                <div class="alert alert-success">
                                    {{ session('berhasil') }}
                                </div>
                            @elseif (session('gagal'))
                                <div class="alert alert-danger">
                                    {{ session('gagal') }}
                                </div>
                            @endif
                        </div>


                        <div class="card">
                            <div class="container-fluid mt-4">
                                {{-- Card User Profile --}}
                                <div class="row g-3" data-aos="fade-up" data-aos-offset="200" data-aos-delay="50"
                                    data-aos-duration="1000">
                                    <div class="col-lg-4 col-md-6 mt-4 pe-2">
                                        <div
                                            class="card-profile d-flex justify-content-center align-items-center py-3 rounded-lg flex-column">
                                            <div class="col-md-15">
                                                @if ($user->photo)
                                                    <img src="{{ Storage::url($user->photo) }}" alt="{{ $user->id }}"
                                                        style="width: 130px; height:130px"
                                                        class="img-thumbnail rounded-circle mx-auto d-block">
                                                @else
                                                    <img src="/../../assets/admin/images/profile.png" alt=""
                                                        style="width: 130px; height:130px"
                                                        class="img-thumbnail rounded-circle mx-auto d-block">
                                                @endif
                                            </div>

                                            <div class="person-name">
                                                <h2 class="text-center fs-4 my-2">{{ Auth::user()->name }}</h2>
                                            </div>
                                            <div class="person-email">
                                                <h3 class="text-center fs-5 fw-normal mb-3">{{ Auth::user()->email }}</h3>
                                            </div>
                                            <div class="bt">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#updateModal{{ $user->id }}">
                                                    Edit Profile
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8 col-md-6 mt-4 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Data Pengguna</h5>
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input type="text" class="form-control" id="username"
                                                        value="{{ $user->username }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                        value="{{ $user->email }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" id="name"
                                                        value="{{ $user->name }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="keterangan" class="form-label">Keterangan Identitas</label>
                                                    <input type="text" class="form-control" id="keterangan"
                                                        value="{{ $user->keterangan }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                                    <input type="text" class="form-control" id="tgl_lahir"
                                                        value="{{ $user->tgl_lahir }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="tmpt_lahir" class="form-label">Tempat Lahir</label>
                                                    <input type="text" class="form-control" id="tmpt_lahir"
                                                        value="{{ $user->tmpt_lahir }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="no_telp" class="form-label">No Telepon</label>
                                                    <input type="text" class="form-control" id="no_telp"
                                                        value="{{ $user->no_telp }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <textarea class="form-control" id="alamat" rows="3" readonly>{{ $user->alamat }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kelurahan" class="form-label">Kelurahan</label>
                                                    <input type="text" class="form-control" id="kelurahan"
                                                        value="{{ $user->kelurahan }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="id_kodepos" class="form-label">Kode Pos</label>
                                                    <input type="text" class="form-control" id="id_kodepos"
                                                        value="{{ $user->id_kodepos }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                                    <input type="text" class="form-control" id="kecamatan"
                                                        value="{{ $user->kecamatan }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kota_kab" class="form-label">Kabupaten</label>
                                                    <input type="text" class="form-control" id="kota_kab"
                                                        value="{{ $user->kota_kab }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="provinsi" class="form-label">Provinsi</label>
                                                    <input type="text" class="form-control" id="provinsi"
                                                        value="{{ $user->provinsi }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- End Form Edit User Profile --}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="updateModal{{ $user->id }}" tabindex="-1" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form -->
                    <form action="{{ route('profile.update', $user->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $user->name }}">
                        </div>

                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="{{ $user->username }}" disabled>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $user->email }}">
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" value="{{ $user->alamat }}"
                                placeholder="Tuliskan Alamat...">{{ $user->alamat }}</textarea>
                        </div>

                        <!-- No Telepon -->
                        <div class="mb-3">
                            <label for="no_telp" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" id="no_telp" name="no_telp"
                                placeholder="08xxxxxxxxxx" value="{{ $user->no_telp }}">
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                value="{{ $user->tgl_lahir }}">
                        </div>

                        {{-- Tempat Lahir --}}
                        <div class="mb-3">
                            <label for="tmpt_lahir" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tmpt_lahir" name="tmpt_lahir"
                                placeholder="Tempat Lahir" value="{{ $user->tmpt_lahir }}">
                        </div>

                        <!-- Kelurahan -->
                        <div class="mb-3">
                            <label for="kelurahan" class="form-label">Kelurahan</label>
                            <input type="text" class="form-control" id="kelurahan" name="kelurahan"
                                placeholder="Kelurahan" value="{{ $user->kelurahan }}">
                        </div>

                        <!-- Kecamatan -->
                        <div class="mb-3">
                            <label for="kecamatan" class="form-label">Kecamatan</label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan"
                                placeholder="Kecamatan" value="{{ $user->kecamatan }}">
                        </div>

                        <!-- Kota/Kabupaten -->
                        <div class="mb-3">
                            <label for="kota_kab" class="form-label">Kota/Kabupaten</label>
                            <input type="text" class="form-control" id="kota_kab" name="kota_kab"
                                placeholder="Kota/Kabupaten" value="{{ $user->kota_kab }}">
                        </div>

                        <!-- Provinsi -->
                        <div class="mb-3">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <input type="text" class="form-control" id="provinsi" name="provinsi"
                                placeholder="Provinsi" value="{{ $user->provinsi }}">
                        </div>

                        <!-- Kode Pos -->
                        <div class="mb-3">
                            <label for="id_kodepos" class="form-label">Kode Pos</label>
                            <input type="text" class="form-control" id="id_kodepos" name="id_kodepos"
                                placeholder="Kode Pos" value="{{ $user->id_kodepos }}">
                        </div>

                        <!-- Keterangan -->
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <select class="form-control mb-3" name="keterangan" required>
                                <option value="" selected>-- Pilih saja --</option>
                                @if ($user->keterangan == 'TU')
                                    <option value="TU" selected>TU</option>
                                    <option value="SISWA">Siswa</option>
                                @elseif($user->keterangan == 'SISWA')
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

                        <!-- Jenis Kelamin -->
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                            <select class="form-control mb-3" name="jenis_kelamin" required>
                                <option value="" selected>-- Pilih saja --</option>
                                @if ($user->jenis_kelamin == 'Laki-laki')
                                    <option value="Laki-laki" selected>Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                @elseif($user->jenis_kelamin == 'Perempuan')
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan" selected>Perempuan</option>
                                @else
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                @endif
                            </select>
                            @error('jenis_kelamin')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Foto -->
                        <div class="mb-3">
                            <label for="photo" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="photo" name="photo">
                            <img src="{{ Storage::url($user->photo) }}" alt="{{ $user->id }}"
                                style="width: 130px; height:130px" class="img-thumbnail rounded-circle mx-auto d-block">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

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
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status')}}
                        </div>
                    @endif

                    <div class="card">
                        <div class="container-fluid mt-4">
                            {{-- Card User Profile --}}
                            <div class="row g-3" data-aos="fade-up" data-aos-offset="200" data-aos-delay="50"
                                data-aos-duration="1000">
                                <div class="col-lg-4 col-md-6 mt-4 pe-2">
                                    <div class="card-profile d-flex justify-content-center align-items-center py-3 rounded-lg flex-column">
                                        <div class="col-md-15">
                                            @if($user->photo)
                                                <img src="{{ asset("storage/photos/".$user->photo) }}" alt="" style="width: 130px; height:130px" class="img-thumbnail rounded-circle mx-auto d-block">
                                            @else
                                                <img src="/../../assets/admin/images/profile.png" alt="" style="width: 130px; height:130px" class="img-thumbnail rounded-circle mx-auto d-block">
                                            @endif
                                        </div>

                                        <div class="person-name">
                                            <h2 class="text-center fs-4 my-2">{{ Auth::user()->name }}</h2>
                                        </div>
                                        <div class="person-email">
                                            <h3 class="text-center fs-5 fw-normal mb-3">{{ Auth::user()->email }}</h3>
                                        </div>
                                        <div class="bt">
                                            {{-- <button class="btn btn-outline-thema"> Edit </button> --}}
                                            <button onclick="" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalEdit" class="btn btn-primary fw-bold rounded-pill px-4 shadow float-end">
                                                <i class="bi bi-pencil-square"></i> Update
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-8 col-md-6 mt-4 pe-2 ps-2 mb-1">
                                    <div class="card-profile d-flex flex-column px-0 py-4">
                                        <div class=" p-3">
                                            <div class="row">
                                                <div class="col-md-12 stretch-card">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <form action="" method="POST" class="row g-3 fw-bold">
                                                                @method("PATCH")
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Username</label>
                                                                            <input type="text" name="username" class="form-control" value="{{ old("username", Auth::user()->username) }}">
                                                                        </div>
                                                                    </div><!-- Col -->

                                                                    <div class="col-sm-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Email</label>
                                                                            <input type="email" name="email" class="form-control" value="{{ old("email", Auth::user()->email) }}">
                                                                        </div>
                                                                    </div><!-- Col -->
                                                                </div><!-- Row -->

                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Nama</label>
                                                                            <input type="text" name="name" class="form-control" value="{{ old("name", Auth::user()->name) }}">
                                                                        </div>
                                                                    </div><!-- Col -->

                                                                    <div class="col-sm-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Tanggal lahir</label>
                                                                            <input type="text" class="form-control" placeholder="Tambahkan tempat & tanggal lahir" value="{{ old("tgl_lahir", Auth::user()->tgl_lahir) }}">
                                                                        </div>
                                                                    </div><!-- Col -->

                                                                    <div class="col-sm-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">No Telepon</label>
                                                                            <input type="text" class="form-control" autocomplete="off" placeholder="Tambahkan no telepon" value="{{ old("no_telp", Auth::user()->no_telp) }}">
                                                                        </div>
                                                                    </div><!-- Col -->
                                                                </div><!-- Row -->

                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="mb-3">
                                                                            <label class="form-label">Alamat</label>
                                                                            <input type="text" class="form-control" placeholder="Tambahkan alamat" value="{{ old("alamat", Auth::user()->alamat) }}">
                                                                        </div>
                                                                    </div><!-- Col -->
                                                                </div><!-- Row -->
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
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

 <!-- Modal Edit Photo-->
 <div class="modal fade" id="exampleModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header hader">
                <h3 class="modal-title" id="exampleModalLabel">
                    Edit Profile
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route("profile.update", $user->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                {{-- PERBEDAAN
                    PUT digunakan untuk melakukan update resource ke sebuah server.
                    dengan PUT method bisa mengirimkan secara keseluruhan data atau replace total
                    PATCH digunakan untuk melakukan update resource ke sebuah server.
                    melakukan update secara partial atau hanya separuh data yang di inginkan untuk diupdate
                --}}
                @csrf
                {{-- <div class="card-header card-header-primary">
                <h4 class="card-title">Edit Profile</h4>
                <p class="card-category">User information</p>
                </div> --}}
                <div class="modal-body" id="modal-content-edit">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control"  value="{{ $user->username }}">
                                @error('username')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div><!-- Col -->

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"  value="{{ $user->email }}">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control"  value="{{ $user->name }}">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>Tanggal lahir</label>
                                <input type="date" name="tgl_lahir" class="form-control"  value="{{ $user->tgl_lahir }}">
                                @error('tgl_lahir')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label>No Telepon</label>
                                <input type="number" name="no_telp" class="form-control"  value="{{ $user->no_telp }}" placeholder="Masukaan no telepon">
                                @error('no_telp')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="mb-3">
                                <label>Alamat</label>
                                <input type="text" name="alamat" class="form-control"  value="{{ $user->alamat }}" placeholder="Masukkan alamat">
                                @error('alamat')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col mb-12">
                            <label for="password-confirm" class="col-sm-2 col-form-label">Foto Profile</label>
                                <img src="{{ asset('storage/photos/'.$user->photo) }}" alt="" style="width: 20%;" class="img-thumbnail rounded mx-auto d-block">
                                <br>
                            <div class="col mb-6">
                                <input id="photo" type="file" class="form-control" name="photo">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-md-block mt-2">
                    <button type="submit" class="btn btn-success btn-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

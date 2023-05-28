@extends('layouts_user.ebook_main')

@section('container')
    <section class="page-header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-8">
                    <div class="title-block">
                        <h1>Riwayat Ebook</h1>
                        <ul class="header-bradcrumb justify-content-center">
                            <li><a href="index.html">Home</a></li>
                            <li class="active" aria-current="page">Riwayat Ebook</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="woocommerce single page-wrapper">
        <div class="container">
            <div class="row">
                <div class="p-2 container card mb-5" style="width: 100%;">
                    {{-- <div class="row row-layanan">
                        <ul class="nav nav-pills nav-fill mb-3">
                            <li class="nav-item">
                                <a class="nav-link text-success fw-bold" aria-current="page"
                                    href="/user/anggota/tampilan/artikel">Ebook</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark fw-bold" href="/user/anggota/tampilan/a-mading">Mading</a>
                            </li>
                        </ul>
                    </div> --}}
                    <div class="col-lg-12 col-xl-12">
                        <div class="woocommerce-cart">
                            <div class="woocommerce-notices-wrapper"></div>
                            <form class="woocommerce-cart-form" action="" method="">
                                <div class="table-responsive">
                                    <table
                                        class="table shop_table shop_table_responsive cart woocommerce-cart-form__contents"
                                        cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center" style="width: 20%;">Cover</th>
                                                <th class="text-center">Kategori</th>
                                                <th class="text-center">Sub-Kategori</th>
                                                <th class="text-center">Judul Ebook</th>
                                                <th class="text-center">Halaman Terakhir Membaca Ebook</th>
                                                <th class="text-center">Penulis Ebook</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($history_ebook as $item)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="text-center">
                                                        <img src="{{ Storage::url($item->ebook->cover) }}" width="150"
                                                            class="rounded" alt="Cover">
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $item->ebook->kategori->nama_kategori }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $item->ebook->subkategori->subkategori }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $item->ebook->judul_buku }}
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn btn-info text-light"
                                                            href="{{ route('landingPage.ebookStory', $item->slug_ebook_item) }}">
                                                            Lanjutkan Membaca {{ $item->slug_ebook_item }}
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $item->ebook->penulis }}
                                                    </td>
                                                </tr>
                                            @endforeach



                                        </tbody>
                                    </table>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Tambah --}}
    <div class="modal fade" id="exampleModalTambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 50%">
            <div class="modal-content">
                <div class="modal-header hader">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Upload Ebook
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-content-detail">
                    <form action="" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="judul_buku">Judul Buku</label>
                                        <input type="text" name="judul_buku"
                                            class="form-control @error('judul_buku') is-invalid @enderror"
                                            placeholder="Tambahkan judul buku">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            {{-- <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="kategori">Kategori</label>
                                    <div>
                                        <select class="form-select" name="kategori_id" id="kategori_id">
                                            <option value="">-- Pilih --</option>

                                        </select>
                                    </div>
                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label class="subkategori">Sub Kategori</label>
                                    <div>
                                        <select class="form-select" name="subkategori_id" id="subkategori_id">
                                            <option value="">-- Pilih --</option>

                                        </select>
                                    </div>
                                </div>
                            </div><!-- Col -->
                        </div><!-- Row --> --}}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="cover">Cover</label>
                                        <input type="file" name="cover" id="cover" class="form-control">
                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        <label class="file">File</label>
                                        <input type="file" name="file"
                                            class="form-control @error('file') is-invalid @enderror"
                                            placeholder="Tambahkan file">
                                    </div>
                                </div><!-- Col -->
                            </div><!-- Row -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb-3">
                                        <label class="sinopsis">Sinopsis</label>
                                        <textarea name="sinopsis" id="sinopsis" class="form-control" rows="5" placeholder="Tambahkan sinopsis"></textarea>
                                    </div>
                                </div><!-- Col -->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success">Kirim</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width:auto">
            <div class="modal-content" style="width:auto">
                <div class="container mt-4 mb-4">
                    <div class="col-md-12">
                        <div class="card-body">
                            {{-- @if ($pl->status == 'Pending') --}}
                            <div class="alert alert-warning" role="alert">
                                Tunggu Konfirmasi Dari Admin
                            </div>
                            {{-- @else --}}
                            {{-- <div class="alert alert-success" role="alert">
                            Layanan Anda tidak memenuhi persyaratan!
                        </div> --}}
                            {{-- @endif --}}
                            <div class="col-12">
                                <p class="text-success" style="font-size: 18px; margin-bottom: 10px">
                                    <b>Cover</b>
                                </p>
                                <p>
                                    <img src="/../../assets/user/images/ebook/jingga&senja.jpg" style="width: 10%;"
                                        style="height:15%;">
                                </p>
                            </div>
                            <div class="col-12">
                                <p class="text-success" style="font-size: 18px; margin-bottom: 10px">
                                    <b>File</b>
                                </p>
                                <p>
                                    <i class="bi bi-file-earmark-text"></i>
                                </p>
                            </div>
                            <div class="col-12">
                                <p class="text-success" style="font-size: 18px; margin-bottom: 10px">
                                    <b>Judul</b>
                                </p>
                                <p>
                                    Menari dan Tertawa
                                </p>
                            </div>
                            <div class="col-12">
                                <p class="text-success" style="font-size: 18px; margin-bottom: 10px">
                                    <b>sinopsis</b>
                                </p>
                                <p class="justify-content">
                                    As you can see the paragraphs gracefully wrap around the floated image. Now imagine how
                                    this would look with some actual content in here, rather than just this boring
                                    placeholder text that goes on and on, but actually conveys no tangible information at.
                                    It simply takes up space and should not really be read.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success col-md-5">Ajukan Kembali</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#sinopsis'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        ClassicEditor
            .create(document.querySelector('#slug'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection

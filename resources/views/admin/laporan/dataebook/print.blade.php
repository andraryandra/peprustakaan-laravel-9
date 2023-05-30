<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Ebook</title>
    <style>
        @page {
            size: A4 landscape;
            /* Mengatur orientasi halaman menjadi landscape */
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead th,
        table tbody td {
            border: 1px solid #000;
            padding: 8px;
        }

        /* Mengatur lebar kolom tabel agar sesuai dengan halaman */
        table thead th:first-child,
        table tbody td:first-child {
            width: 5%;
        }

        table thead th:nth-child(2),
        table tbody td:nth-child(2) {
            width: 15%;
        }

        table thead th:nth-child(3),
        table tbody td:nth-child(3) {
            width: 15%;
        }

        table thead th:nth-child(4),
        table tbody td:nth-child(4) {
            width: 15%;
        }

        table thead th:nth-child(5),
        table tbody td:nth-child(5) {
            width: 20%;
        }

        table thead th:nth-child(6),
        table tbody td:nth-child(6) {
            width: 10%;
        }

        table thead th:nth-child(7),
        table tbody td:nth-child(7) {
            width: 15%;
        }

        table thead th:nth-child(8),
        table tbody td:nth-child(8) {
            width: 10%;
        }
    </style>

</head>

<body>
    <h2>Laporan Ebook</h2>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Diposting Oleh</th>
                <th>Kategori</th>
                <th>Sub Kategori</th>
                <th>Judul Buku</th>
                <th>Sinopsis</th>
                <th>Penulis</th>
                <th>Tahun Terbit</th>
                <th>Status</th>
                <th>Slug</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ebooks as $index => $ebook)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $ebook->user->name }}</td>
                    <td>{{ $ebook->kategori->nama_kategori }}</td>
                    <td>{{ $ebook->subkategori->subkategori }}</td>
                    <td>{{ $ebook->judul_buku }}</td>
                    <td>{!! $ebook->sinopsis !!}</td>
                    <td>{{ $ebook->penulis }}</td>
                    <td>{{ $ebook->tahun_terbit }}</td>
                    <td>{{ $ebook->ebook_item_verify->pluck('verifikasi_ebook')->implode(', ') }}</td>
                    <td>{{ $ebook->slug }}</td>
                    <td>{{ $ebook->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

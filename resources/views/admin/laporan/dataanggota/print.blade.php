<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan History Ebook</title>
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
    <h2>Laporan History Ebook</h2>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>User</th>
                <th>Keterangan User</th>
                <th>Kategori</th>
                <th>Sub Kategori</th>
                <th>Judul Ebook</th>
                <th>Judul Item Ebook</th>
                <th>Link Ebook</th>
                <th>Waktu Akses Item Ebook</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($historyEbooks as $index => $historyEbook)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $historyEbook->user->name }}</td>
                    <td>{{ $historyEbook->user->keterangan }}</td>
                    <td>{{ $historyEbook->ebook->kategori->nama_kategori }}</td>
                    <td>{{ $historyEbook->ebook->subkategori->subkategori }}</td>
                    <td>{{ $historyEbook->ebook->judul_buku }}</td>
                    <td>{{ $historyEbook->ebook_item->judul_part }}</td>
                    <td>{{ $historyEbook->slug_ebook_item }}</td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($historyEbook->accessed_ebook_item_at)->format('d-m-Y') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

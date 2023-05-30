<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Mading</title>
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
    <h2>Laporan Mading</h2>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Diposting Oleh</th>
                {{-- <th>File Gambar</th> --}}
                <th>Judul Mading</th>
                <th>Isi Content Mading</th>
                <th>Verifikasi</th>
                <th>Tags</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($madings as $index => $mading)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $mading->user->name }}</td>
                    {{-- <td>{{ $mading->image }}</td> --}}
                    <td>{{ $mading->judul }}</td>
                    <td>{!! $mading->content !!}</td>
                    <td>{{ $mading->mading_items->pluck('verifikasi_mading')->implode(', ') }}</td>
                    <td>
                        @foreach (json_decode($mading->tags, true) as $tag)
                            {{ $tag['value'] }},
                        @endforeach
                    </td>
                    <td>{{ $mading->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>

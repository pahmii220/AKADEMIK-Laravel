<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Guru</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
        }

        .text-center {
            text-align: center;
        }

        h3,
        h4 {
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <div class="text-center">
        <h3>LAPORAN DATA GURU</h3>
        <h4>SMKN 3 BANJARMASIN</h4>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIP</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Status</th>
                <th>Pendidikan</th>
                <th>Keahlian</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($guruList as $g)
                <tr>
                    <td>{{ $g->nama_guru }}</td>
                    <td>{{ $g->nip }}</td>
                    <td>{{ $g->jenis_kelamin }}</td>
                    <td>{{ $g->tanggal_lahir }}</td>
                    <td>{{ $g->status_pegawai }}</td>
                    <td>{{ $g->pendidikan_terakhir }}</td>
                    <td>{{ $g->keahlian_utama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>     
<!DOCTYPE html>
<html>

<head>
    <title>Laporan Jurusan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h3>Laporan Data Jurusan</h3>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Jurusan</th>
                <th>Singkatan</th>
                <th>Kepala Jurusan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jurusanList as $j)
                <tr>
                    <td>{{ $j->kode_jurusan }}</td>
                    <td>{{ $j->nama_jurusan }}</td>
                    <td>{{ $j->singkatan }}</td>
                    <td>{{ $j->kepala_jurusan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
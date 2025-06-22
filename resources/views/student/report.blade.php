<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Siswa</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10px;
        }

        .header-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .header-title h2 {
            margin: 0;
            font-size: 18px;
        }

        .header-title h4 {
            margin: 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>

<body>

    <div class="header-title">
        <h2>LAPORAN DATA SISWA</h2>
        <h4>SMKN 3 Banjarmasin</h4>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>NIS</th>
                <th>Gol. Darah</th>
                <th>Agama</th>
                <th>Email</th>
                <th>Kelas</th>
                <th>Section</th>
                <th>Jurusan</th>
                <th>ID Penerimaan</th>
                <th>No. Telepon</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                    <td>{{ $student->jenis_kelamin }}</td>
                    <td>{{ $student->date_of_birth }}</td>
                    <td>{{ $student->roll }}</td>
                    <td>{{ $student->blood_group }}</td>
                    <td>{{ $student->religion }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->class }}</td>
                    <td>{{ $student->section }}</td>
                    <td>{{ $student->jurusan }}</td>
                    <td>{{ $student->admission_id }}</td>
                    <td>{{ $student->phone_number }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
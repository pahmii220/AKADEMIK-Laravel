@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <h3 class="page-title">Filter Laporan Data Siswa</h3>
            </div>

            {{-- Filter Form --}}
            <form method="GET" action="{{ route('student.report.filter') }}">
                <div class="row">
                    <div class="col-md-4">
                        <label>Jurusan</label>
                        <select name="jurusan" class="form-control">
                            <option value="">-- Semua Jurusan --</option>
                            @foreach($jurusanList as $jurusan)
                                <option value="{{ $jurusan->nama_jurusan }}" {{ request('jurusan') == $jurusan->nama_jurusan ? 'selected' : '' }}>
                                    {{ $jurusan->nama_jurusan }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Kelas</label>
                        <select name="kelas" class="form-control">
                            <option value="">-- Semua Kelas --</option>
                            @for($i = 10; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ request('kelas') == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">Tampilkan</button>
                        <a href="{{ route('student.report.pdf', request()->only(['jurusan', 'kelas'])) }}" target="_blank"
                            class="btn btn-success">
                            Download PDF
                        </a>
                    </div>
                </div>
            </form>

            <hr>

            {{-- Tampilkan Data --}}
            @if($students->count())
                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
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
                </div>
            @elseif(request()->has('jurusan') || request()->has('kelas'))
                <div class="alert alert-warning mt-3">
                    Tidak ada data ditemukan untuk filter yang dipilih.
                </div>
            @endif

        </div>
    </div>
@endsection
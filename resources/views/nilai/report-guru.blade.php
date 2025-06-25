@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <h4>Laporan Nilai Saya</h4>
            </div>

            <div class="card card-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Nilai</th>
                                    <th>Keterangan</th>
                                    <th>Sikap</th>
                                    <th>Tahun Ajaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->student->first_name }} {{ $item->student->last_name }}</td>
                                        <td>{{ $item->nilai }}</td>
                                        <td>{{ $item->keterangan_nilai }}</td>
                                        <td>{{ $item->sikap }}</td>
                                        <td>{{ $item->tahun_ajaran }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
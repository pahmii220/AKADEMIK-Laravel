@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <h3>Laporan Data Jurusan</h3>

            <form action="{{ route('jurusan.report.view') }}" method="GET" class="row mb-4">
                <div class="col-md-4">
                    <label>Kepala Jurusan</label>
                    <input type="text" name="kepala_jurusan" class="form-control" placeholder="Cari nama kepala jurusan">
                </div>
                <div class="col-md-4">
                    <label>Singkatan</label>
                    <input type="text" name="singkatan" class="form-control" placeholder="Contoh: TKJ, RPL, AKL">
                </div>
                <div class="col-md-4 mt-4 d-flex gap-2 align-items-center">
                    <button class="btn btn-primary">
                        <i class="fas fa-filter me-1"></i> Tampilkan
                    </button>
                    @if(isset($jurusanList))
                        <a href="{{ route('jurusan.report.pdf', request()->query()) }}" target="_blank" class="btn btn-success">
                            <i class="fas fa-file-pdf me-1"></i> PDF
                        </a>
                    @endif
                </div>
            </form>

            @if(isset($jurusanList))
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Jurusan</th>
                            <th>Singkatan</th>
                            <th>Kepala Jurusan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jurusanList as $j)
                            <tr>
                                <td>{{ $j->kode_jurusan }}</td>
                                <td>{{ $j->nama_jurusan }}</td>
                                <td>{{ $j->singkatan }}</td>
                                <td>{{ $j->kepala_jurusan }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
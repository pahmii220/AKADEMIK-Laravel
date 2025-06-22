@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <h3>Laporan Data Guru</h3>
            <form action="{{ route('guru.report.view') }}" method="GET" class="mb-3 row">
                <div class="col-md-4">
                    <label>Status Pegawai</label>
                    <select name="status_pegawai" class="form-control">
                        <option value="">Semua</option>
                        <option value="PNS">PNS</option>
                        <option value="Honorer">Honorer</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label>Pendidikan Terakhir</label>
                    <select name="pendidikan" class="form-control">
                        <option value="">Semua</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                    </select>
                </div>
                <div class="col-md-4 mt-4 d-flex gap-2 align-items-center">
                    <button class="btn btn-primary">Tampilkan</button>
                    @if(isset($guruList))
                        <a href="{{ route('guru.report.pdf', request()->query()) }}" target="_blank" class="btn btn-success">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                    @endif
                </div>
            </form>

            @if(isset($guruList))
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Status Pegawai</th>
                            <th>Pendidikan</th>
                            <th>Keahlian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($guruList as $g)
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
            @endif
        </div>
    </div>
@endsection
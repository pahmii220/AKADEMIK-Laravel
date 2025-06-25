@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Input Nilai Siswa</h3>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('nilai.store') }}" method="POST">
                @csrf

                <div class="row">
                    {{-- Nama Siswa --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="student_id">Nama Siswa</label>
                            <select name="student_id" class="form-control" required>
                                <option value="">-- Pilih Siswa --</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Nilai --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nilai">Nilai</label>
                            <input type="number" name="nilai" class="form-control" min="0" max="100" required>
                        </div>
                    </div>

                    {{-- Keterangan Nilai --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="keterangan_nilai">Keterangan Nilai</label>
                            <input type="text" name="keterangan_nilai" class="form-control"
                                placeholder="Tuntas / Belum Tuntas">
                        </div>
                    </div>

                    {{-- Sikap --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sikap">Sikap</label>
                            <select name="sikap" class="form-control">
                                <option value="">-- Pilih Sikap --</option>
                                <option value="Sangat Baik">Sangat Baik</option>
                                <option value="Baik">Baik</option>
                                <option value="Cukup">Cukup</option>
                                <option value="Kurang">Kurang</option>
                            </select>
                        </div>
                    </div>

                    {{-- Tahun Ajaran --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun_ajaran">Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" class="form-control" placeholder="2024/2025" required>
                        </div>
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="col-md-12 mt-3">
                        <button type="submit" class="btn btn-primary">Simpan Nilai</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Edit Nilai Siswa</h3>
                    </div>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('nilai.update', $nilai->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-group">
                                    <label>Nama Siswa</label>
                                    <select name="student_id" class="form-control" required>
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}" {{ $nilai->student_id == $student->id ? 'selected' : '' }}>
                                                {{ $student->first_name }} {{ $student->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Nilai</label>
                                    <input type="number" name="nilai" class="form-control" value="{{ $nilai->nilai }}"
                                        min="0" max="100" required>
                                </div>

                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" name="keterangan_nilai" class="form-control"
                                        value="{{ $nilai->keterangan_nilai }}">
                                </div>

                                <div class="form-group">
                                    <label>Sikap</label>
                                    <input type="text" name="sikap" class="form-control" value="{{ $nilai->sikap }}">
                                </div>

                                <div class="form-group">
                                    <label>Tahun Ajaran</label>
                                    <input type="text" name="tahun_ajaran" class="form-control"
                                        value="{{ $nilai->tahun_ajaran }}" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('nilai.list') }}" class="btn btn-secondary">Kembali</a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
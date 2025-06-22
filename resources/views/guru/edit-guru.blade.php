@extends('layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Edit Guru</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('guru.list') }}">Guru</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Guru</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('guru.update', $guru->id) }}" method="POST">
                                @csrf
                                @method('PUT')  {{-- Tambahkan ini untuk spoof method PUT --}}
                                <input type="hidden" name="id" value="{{ $guru->id }}">
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Data Dasar</span></h5>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>NIP <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip"
                                                placeholder="Masukkan NIP" value="{{ $guru->nip }}">
                                            @error('nip')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nama <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control @error('nama_guru') is-invalid @enderror" name="nama_guru"
                                                placeholder="Masukkan Nama" value="{{ $guru->nama_guru }}">
                                            @error('nama_guru')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Jenis Kelamin <span class="login-danger">*</span></label>
                                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                                                <option selected disabled>Pilih Jenis Kelamin</option>
                                                <option value="Laki-laki" {{ $guru->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                                </option>
                                                <option value="Perempuan" {{ $guru->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                                </option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Tanggal Lahir <span class="login-danger">*</span></label>
                                            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                name="tanggal_lahir" value="{{ $guru->tanggal_lahir }}">
                                            @error('tanggal_lahir')
                                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Agama</label>
                                            <select class="form-control" name="agama">
                                                <option selected disabled>Pilih Agama</option>
                                                <option value="Islam" {{ $guru->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="Kristen" {{ $guru->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="Katolik" {{ $guru->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                                <option value="Hindu" {{ $guru->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="Buddha" {{ $guru->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                                <option value="Konghucu" {{ $guru->agama == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Status Pegawai</label>
                                            <select class="form-control" name="status_pegawai">
                                                <option selected disabled>Pilih Status</option>
                                                <option value="PNS" {{ $guru->status_pegawai == 'PNS' ? 'selected' : '' }}>PNS</option>
                                                <option value="Honorer" {{ $guru->status_pegawai == 'Honorer' ? 'selected' : '' }}>Honorer</option>
                                                <option value="Kontrak" {{ $guru->status_pegawai == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Keahlian Utama</label>
                                            <input type="text" class="form-control" name="keahlian_utama" value="{{ $guru->keahlian_utama }}">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Pendidikan Terakhir</label>
                                            <input type="text" class="form-control" name="pendidikan_terakhir"
                                                value="{{ $guru->pendidikan_terakhir }}">
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-between">
                                        <a href="{{ route('guru.list') }}" class="btn btn-secondary">Kembali</a>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
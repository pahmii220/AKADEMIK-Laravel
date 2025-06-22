@extends('layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Tambah Guru</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('guru.list') }}">Guru</a></li>
                            <li class="breadcrumb-item active">Tambah Guru</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('guru.save') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Data Guru</span></h5>
                                    </div>

                                    {{-- NIP --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>NIP <span class="login-danger">*</span></label>
                                            <input type="text" name="nip"
                                                class="form-control @error('nip') is-invalid @enderror" placeholder="NIP"
                                                value="{{ old('nip') }}">
                                            @error('nip')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Nama Guru --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nama Guru <span class="login-danger">*</span></label>
                                            <input type="text" name="nama_guru"
                                                class="form-control @error('nama_guru') is-invalid @enderror"
                                                placeholder="Nama Guru" value="{{ old('nama_guru') }}">
                                            @error('nama_guru')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Jenis Kelamin --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Jenis Kelamin <span class="login-danger">*</span></label>
                                            <select name="jenis_kelamin"
                                                class="form-control @error('jenis_kelamin') is-invalid @enderror">
                                                <option selected disabled>-- Pilih Jenis Kelamin --</option>
                                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Tanggal Lahir --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Tanggal Lahir <span class="login-danger">*</span></label>
                                            <input type="date" name="tanggal_lahir"
                                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                value="{{ old('tanggal_lahir') }}">
                                            @error('tanggal_lahir')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Agama --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Agama <span class="login-danger">*</span></label>
                                            <select name="agama" class="form-control @error('agama') is-invalid @enderror">
                                                <option selected disabled>-- Pilih Agama --</option>
                                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam
                                                </option>
                                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>
                                                    Kristen</option>
                                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>
                                                    Katolik</option>
                                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu
                                                </option>
                                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha
                                                </option>
                                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>
                                                    Konghucu</option>
                                            </select>
                                            @error('agama')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Status Pegawai --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Status Pegawai <span class="login-danger">*</span></label>
                                            <select name="status_pegawai"
                                                class="form-control @error('status_pegawai') is-invalid @enderror">
                                                <option selected disabled>-- Pilih Status Pegawai --</option>
                                                <option value="PNS" {{ old('status_pegawai') == 'PNS' ? 'selected' : '' }}>PNS
                                                </option>
                                                <option value="Honorer" {{ old('status_pegawai') == 'Honorer' ? 'selected' : '' }}>Honorer</option>
                                                <option value="Kontrak" {{ old('status_pegawai') == 'Kontrak' ? 'selected' : '' }}>Kontrak</option>
                                            </select>
                                            @error('status_pegawai')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Keahlian Utama --}}
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Keahlian Utama <span class="login-danger">*</span></label>
                                            <input type="text" name="keahlian_utama"
                                                class="form-control @error('keahlian_utama') is-invalid @enderror"
                                                placeholder="Keahlian Utama" value="{{ old('keahlian_utama') }}">
                                            @error('keahlian_utama')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Pendidikan Terakhir --}}
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Pendidikan Terakhir <span class="login-danger">*</span></label>
                                            <input type="text" name="pendidikan_terakhir"
                                                class="form-control @error('pendidikan_terakhir') is-invalid @enderror"
                                                placeholder="Pendidikan Terakhir" value="{{ old('pendidikan_terakhir') }}">
                                            @error('pendidikan_terakhir')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Tahun Aktif Kerja --}}
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Tahun Aktif Kerja <span class="login-danger">*</span></label>
                                            <input type="number" name="tahun_aktif_kerja"
                                                class="form-control @error('tahun_aktif_kerja') is-invalid @enderror"
                                                placeholder="Contoh: 2020" value="{{ old('tahun_aktif_kerja') }}">
                                            @error('tahun_aktif_kerja')
                                                <span class="invalid-feedback"
                                                    role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Button --}}
                                    <div class="col-12 d-flex justify-content-between">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>

                                </div> {{-- end row --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.master')

@section('content')
    {{-- pesan --}}
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Tambah Jurusan</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('jurusan.list') }}">Jurusan</a></li>
                            <li class="breadcrumb-item active">Tambah Jurusan</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('jurusan.save') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Informasi Jurusan</span></h5>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Kode Jurusan <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="kode_jurusan"
                                                placeholder="Masukkan Kode Jurusan" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nama Jurusan <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="nama_jurusan"
                                                placeholder="Masukkan Nama Jurusan" required>
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Singkatan</label>
                                            <input type="text" class="form-control" name="singkatan"
                                                placeholder="Masukkan Singkatan">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Kepala Jurusan</label>
                                            <input type="text" class="form-control" name="kepala_jurusan"
                                                placeholder="Masukkan Kepala Jurusan">
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
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
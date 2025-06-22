@extends('layouts.master')

@section('content')
    {{-- Toastr message --}}
    {!! Toastr::message() !!}

    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Tambah Berita</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Berita</a></li>
                            <li class="breadcrumb-item active">Tambah Berita</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">

                            {{-- FORM TAMBAH --}}
                            <form action="{{ route('berita.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Detail Berita</span></h5>
                                    </div>

                                    {{-- Judul --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Judul <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="judul" required>
                                        </div>
                                    </div>

                                    {{-- Isi --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Isi Berita <span class="text-danger">*</span></label>
                                            <textarea name="isi" rows="6" class="form-control" required></textarea>
                                        </div>
                                    </div>

                                    {{-- Gambar --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Upload Gambar (Opsional)</label>
                                            <input type="file" name="gambar" class="form-control" accept="image/*">
                                            <small class="text-muted">Maks. 2MB. Format: jpg, jpeg, png</small>
                                        </div>
                                    </div>

                                    {{-- Tombol --}}
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                            <a href="{{ route('berita.list') }}" class="btn btn-secondary">Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            {{-- VALIDASI ERROR --}}
                            @if($errors->any())
                                <div class="alert alert-danger mt-3">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
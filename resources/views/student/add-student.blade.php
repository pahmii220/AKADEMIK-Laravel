@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            {{-- Header --}}
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Tambah Data Siswa</h3>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Notifikasi --}}
            {!! Toastr::message() !!}

            {{-- Form Input --}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('student/add/save') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title student-info">
                                            Informasi Data Siswa
                                            <span><a href="javascript:;"><i class="feather-more-vertical"></i></a></span>
                                        </h5>
                                    </div>

                                    {{-- Nama Awal --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nama Awal <span class="login-danger">*</span></label>
                                            <input type="text" name="first_name" value="{{ old('first_name') }}"
                                                class="form-control" required>
                                        </div>
                                    </div>

                                    {{-- Nama Akhir --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nama Akhir <span class="login-danger">*</span></label>
                                            <input type="text" name="last_name" value="{{ old('last_name') }}"
                                                class="form-control" required>
                                        </div>
                                    </div>

                                    {{-- Jenis Kelamin --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Jenis Kelamin <span class="login-danger">*</span></label>
                                            <select name="jenis_kelamin" class="form-control" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Tanggal Lahir --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Tanggal Lahir <span class="login-danger">*</span></label>
                                            <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                                class="form-control" required>
                                        </div>
                                    </div>

                                    {{-- NIS --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>NIS</label>
                                            <input type="text" name="roll" value="{{ old('roll') }}" class="form-control">
                                        </div>
                                    </div>

                                    {{-- Golongan Darah --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Golongan Darah <span class="login-danger">*</span></label>
                                            <select name="blood_group" class="form-control" required>
                                                <option value="">Pilih Golongan Darah</option>
                                                <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+
                                                </option>
                                                <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+
                                                </option>
                                                <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Agama --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Agama <span class="login-danger">*</span></label>
                                            <select name="religion" class="form-control" required>
                                                <option value="">Pilih Agama</option>
                                                @foreach(['Islam', 'Kristen', 'Hindu', 'Budha', 'Konghucu', 'Lainnya'] as $agama)
                                                    <option value="{{ $agama }}" {{ old('religion') == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>E-Mail <span class="login-danger">*</span></label>
                                            <input type="email" name="email" value="{{ old('email') }}" class="form-control"
                                                required>
                                        </div>
                                    </div>

                                    {{-- Kelas --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Kelas <span class="login-danger">*</span></label>
                                            <select name="class" class="form-control" required>
                                                <option value="">Pilih Kelas</option>
                                                @foreach(['10', '11', '12'] as $kelas)
                                                    <option value="{{ $kelas }}" {{ old('class') == $kelas ? 'selected' : '' }}>
                                                        {{ $kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Jurusan --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Jurusan <span class="login-danger">*</span></label>
                                            <select name="jurusan" class="form-control" required>
                                                <option value="">Pilih Jurusan</option>
                                                @foreach ($jurusanList as $jurusan)
                                                    <option value="{{ $jurusan->nama_jurusan }}" {{ old('jurusan') == $jurusan->nama_jurusan ? 'selected' : '' }}>
                                                        {{ $jurusan->nama_jurusan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Seksi --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Seksi <span class="login-danger">*</span></label>
                                            <select name="section" class="form-control" required>
                                                <option value="">Pilih Seksi</option>
                                                @foreach(['A', 'B', 'C'] as $seksi)
                                                    <option value="{{ $seksi }}" {{ old('section') == $seksi ? 'selected' : '' }}>
                                                        {{ $seksi }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- ID Penerimaan --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>ID Penerimaan</label>
                                            <input type="text" name="admission_id" value="{{ old('admission_id') }}"
                                                class="form-control">
                                        </div>
                                    </div>

                                    {{-- Nomor Telepon --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nomor Telepon</label>
                                            <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                                                class="form-control"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                        </div>
                                    </div>

                                    {{-- Tombol Kirim --}}
                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </div>
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
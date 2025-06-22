@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">Tambah Data Siswa</h3>
                        </div>
                    </div>
                </div>
            </div>

            {{-- message --}}
            {!! Toastr::message() !!}

            <div class="row">
                <div class="col-sm-12">
                    <div class="card comman-shadow">
                        <div class="card-body">
                            <form action="{{ route('student/add/save') }}" method="POST" enctype="multipart/form-data">
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
                                            <input type="text" name="first_name"
                                                class="form-control @error('first_name') is-invalid @enderror"
                                                placeholder="Masukkan Nama Awal" value="{{ old('first_name') }}">
                                            @error('first_name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Nama Akhir --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Nama Akhir <span class="login-danger">*</span></label>
                                            <input type="text" name="last_name"
                                                class="form-control @error('last_name') is-invalid @enderror"
                                                placeholder="Masukkan Nama Akhir" value="{{ old('last_name') }}">
                                            @error('last_name')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Jenis Kelamin --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Jenis Kelamin <span class="login-danger">*</span></label>
                                            <select name="jenis_kelamin"
                                                class="form-control select @error('jenis_kelamin') is-invalid @enderror">
                                                <option selected disabled>Pilih Jenis Kelamin</option>
                                                <option value="Laki-Laki" {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                            @error('jenis_kelamin')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Tanggal Lahir --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms calendar-icon">
                                            <label>Tanggal Lahir <span class="login-danger">*</span></label>
                                            <input type="text" name="date_of_birth"
                                                class="form-control datetimepicker @error('date_of_birth') is-invalid @enderror"
                                                placeholder="DD-MM-YYYY" value="{{ old('date_of_birth') }}">
                                            @error('date_of_birth')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- NIS --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>NIS</label>
                                            <input type="text" name="roll"
                                                class="form-control @error('roll') is-invalid @enderror"
                                                placeholder="Masukkan NIS" value="{{ old('roll') }}">
                                            @error('roll')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Golongan Darah --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Golongan Darah <span class="login-danger">*</span></label>
                                            <select name="blood_group"
                                                class="form-control select @error('blood_group') is-invalid @enderror">
                                                <option selected disabled>Pilih Golongan Darah</option>
                                                <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+
                                                </option>
                                                <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+
                                                </option>
                                                <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+
                                                </option>
                                            </select>
                                            @error('blood_group')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Agama --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Agama <span class="login-danger">*</span></label>
                                            <select name="religion"
                                                class="form-control select @error('religion') is-invalid @enderror">
                                                <option selected disabled>Pilih Agama</option>
                                                <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam
                                                </option>
                                                <option value="Kristen" {{ old('religion') == 'Kristen' ? 'selected' : '' }}>
                                                    Kristen</option>
                                                <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu
                                                </option>
                                                <option value="Budha" {{ old('religion') == 'Budha' ? 'selected' : '' }}>Budha
                                                </option>
                                                <option value="Konghucu" {{ old('religion') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                                <option value="Lainnya" {{ old('religion') == 'Lainnya' ? 'selected' : '' }}>
                                                    Lainnya</option>
                                            </select>
                                            @error('religion')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>E-Mail <span class="login-danger">*</span></label>
                                            <input type="text" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Masukkan Alamat Email" value="{{ old('email') }}">
                                            @error('email')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Kelas --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Kelas <span class="login-danger">*</span></label>
                                            <select name="class"
                                                class="form-control select @error('class') is-invalid @enderror">
                                                <option selected disabled>Pilih Kelas</option>
                                                <option value="12" {{ old('class') == '12' ? 'selected' : '' }}>12</option>
                                                <option value="11" {{ old('class') == '11' ? 'selected' : '' }}>11</option>
                                                <option value="10" {{ old('class') == '10' ? 'selected' : '' }}>10</option>
                                            </select>
                                            @error('class')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Jurusan --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Jurusan <span class="login-danger">*</span></label>
                                            <select name="jurusan"
                                                class="form-control select @error('jurusan') is-invalid @enderror">
                                                <option selected disabled>Pilih Jurusan</option>
                                                @foreach ($jurusanList as $jurusan)
                                                    <option value="{{ $jurusan->nama_jurusan }}" {{ old('jurusan') == $jurusan->nama_jurusan ? 'selected' : '' }}>
                                                        {{ $jurusan->nama_jurusan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('jurusan')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Seksi --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>Seksi <span class="login-danger">*</span></label>
                                            <select name="section"
                                                class="form-control select @error('section') is-invalid @enderror">
                                                <option selected disabled>Pilih Tipe Kelas</option>
                                                <option value="A" {{ old('section') == 'A' ? 'selected' : '' }}>A</option>
                                                <option value="B" {{ old('section') == 'B' ? 'selected' : '' }}>B</option>
                                                <option value="C" {{ old('section') == 'C' ? 'selected' : '' }}>C</option>
                                            </select>
                                            @error('section')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- ID Penerimaan --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>ID Penerimaan</label>
                                            <input type="text" name="admission_id"
                                                class="form-control @error('admission_id') is-invalid @enderror"
                                                placeholder="Masukkan ID Penerimaan" value="{{ old('admission_id') }}">
                                            @error('admission_id')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Telepon --}}
                                    <div class="col-12 col-sm-4">
                                        <div class="form-group local-forms">
                                            <label>No Telepon</label>
                                            <input type="text" name="phone_number"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                placeholder="Masukkan Nomor Telepon" value="{{ old('phone_number') }}"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            @error('phone_number')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
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
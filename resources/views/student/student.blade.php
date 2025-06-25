@extends('layouts.master')
@section('content')

    @php
        $role = Session::get('role_name');
    @endphp

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h3 class="page-title">DATA SISWA SMKN 3 BANJARMASIN</h3>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DATA TABEL --}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Daftar Siswa</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="{{ route('student.report.filter') }}" class="btn btn-sm btn-success">
                                            <i class="fas fa-print fa-lg"></i>
                                        </a>
                                        @if ($role === 'Admin' || $role === 'Super Admin')
                                            <a href="{{ route('student/add/page') }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-plus"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal Lahir</th>
                                            <th>NIS</th>
                                            <th>Golongan Darah</th>
                                            <th>Agama</th>
                                            <th>E-Mail</th>
                                            <th>Kelas</th>
                                            <th>Jurusan</th>
                                            <th>Nomor Handphone</th>
                                            <th class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($studentList as $key => $list)
                                            <tr>
                                                <td>STD{{ ++$key }}</td>
                                                <td hidden class="id">{{ $list->id }}</td>
                                                <td>{{ $list->first_name }} {{ $list->last_name }}</td>
                                                <td>{{ $list->jenis_kelamin }}</td>
                                                <td>{{ $list->date_of_birth }}</td>
                                                <td>{{ $list->roll }}</td>
                                                <td>{{ $list->blood_group }}</td>
                                                <td>{{ $list->religion }}</td>
                                                <td>{{ $list->email }}</td>
                                                <td>{{ $list->class }} {{ $list->section }}</td>
                                                <td>{{ $list->jurusan }}</td>
                                                <td>{{ $list->phone_number }}</td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        @if ($role === 'Admin' || $role === 'Super Admin')
                                                            <a href="{{ url('student/edit/' . $list->id) }}"
                                                                class="btn btn-sm bg-danger-light">
                                                                <i class="far fa-edit me-2"></i>
                                                            </a>
                                                            <a class="btn btn-sm bg-danger-light student_delete"
                                                                data-bs-toggle="modal" data-bs-target="#studentUser">
                                                                <i class="far fa-trash-alt me-2"></i>
                                                            </a>
                                                        @else
                                                            <span class="text-muted">-</span>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL HAPUS SISWA --}}
    @if ($role === 'Admin' || $role === 'Super Admin')
        <div class="modal custom-modal fade" id="studentUser" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Hapus Siswa</h3>
                            <p>Apakah Anda yakin ingin menghapus data ini?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('student/delete') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="id" class="e_id" value="">
                                    <input type="hidden" name="avatar" class="e_avatar" value="">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary continue-btn submit-btn"
                                            style="border-radius: 5px !important;">Delete</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" data-bs-dismiss="modal" class="btn btn-primary paid-cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @section('script')
        <script>
            $(document).on('click', '.student_delete', function () {
                var _this = $(this).parents('tr');
                $('.e_id').val(_this.find('.id').text());
                $('.e_avatar').val(_this.find('.avatar').text());
            });
        </script>
    @endsection

@endsection
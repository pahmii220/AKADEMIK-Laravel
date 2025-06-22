@extends('layouts.master')

@section('content')
    {{-- pesan --}}
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Jurusan</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Data Jurusan</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="{{ route('jurusan.report.filter') }}" class="btn btn-success me-2">
                                            <i class="fas fa-print"></i>
                                        </a>
                                        <a href="{{ route('jurusan.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>
                                                <div class="form-check check-tables">

                                                </div>
                                            </th>
                                            <th>ID</th>
                                            <th>Nama Jurusan</th>
                                            <th>Kode</th>
                                            <th>Singkatan</th>
                                            <th>Kepala Jurusan</th>
                                            <th class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jurusanList as $jurusan)
                                            <tr>
                                                <td>
                                                    <div class="form-check check-tables">
                                                        <input class="form-check-input" type="checkbox">
                                                    </div>
                                                </td>
                                                <td class="jurusan_id">{{ $jurusan->id }}</td>
                                                <td>{{ $jurusan->nama_jurusan }}</td>
                                                <td>{{ $jurusan->kode_jurusan }}</td>
                                                <td>{{ $jurusan->singkatan }}</td>
                                                <td>{{ $jurusan->kepala_jurusan }}</td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a href="{{ url('jurusan/edit/' . $jurusan->id) }}"
                                                            class="btn btn-sm bg-danger-light">
                                                            <i class="far fa-edit me-2"></i>
                                                        </a>
                                                        <a class="btn btn-sm bg-danger-light delete" data-bs-toggle="modal"
                                                            data-bs-target="#delete">
                                                            <i class="fe fe-trash-2"></i>
                                                        </a>
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

    {{-- modal hapus --}}
    <div class="modal custom-modal fade" id="delete" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Hapus Jurusan</h3>
                        <p>Apakah Anda yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <form action="{{ route('jurusan.delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_jurusan_id" value="">
                                <div class="col-6">
                                    <button type="submit" class="btn btn-primary" style="width: 100%;">Hapus</button>
                                </div>
                                <div class="col-6">
                                    <a data-bs-dismiss="modal" class="btn btn-primary">Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    {{-- script modal delete --}}
    <script>
        $(document).on('click', '.delete', function () {
            var _this = $(this).closest('tr');
            $('.e_jurusan_id').val(_this.find('.jurusan_id').text());
        });
    </script>
@endsection
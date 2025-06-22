@extends('layouts.master')


@section('content')
    {!! Toastr::message() !!}
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Data Guru</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Guru</li>
                        </ul>
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
                                        <h3 class="page-title">Daftar Guru</h3>
                                    </div>

                                    <div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="{{ route('guru.report.filter') }}" class="btn btn-success me-2">
                                            <i class="fas fa-print"></i>                                    </a>
                                        <a href="{{ route('guru.add') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="DataList" class="table table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th></th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Agama</th>
                                            <th>Status Pegawai</th>
                                            <th>Keahlian</th>
                                            <th>Pendidikan</th>
                                            <th>Tahun Aktif</th>
                                            <th class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $guru)
                                            <tr>
                                                <td>
                                                    <div class="form-check check-tables">
                                                        <input class="form-check-input" type="checkbox">
                                                    </div>
                                                </td>
                                                <td>{{ $guru->nip }}</td>
                                                <td>{{ $guru->nama_guru }}</td>
                                                <td>{{ $guru->jenis_kelamin }}</td>
                                                <td>{{ $guru->tanggal_lahir }}</td>
                                                <td>{{ $guru->agama }}</td>
                                                <td>{{ $guru->status_pegawai }}</td>
                                                <td>{{ $guru->keahlian_utama }}</td>
                                                <td>{{ $guru->pendidikan_terakhir }}</td>
                                                <td>{{ $guru->tahun_aktif_kerja }}</td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a href="{{ route('guru.edit', $guru->id) }}"
                                                            class="btn btn-sm bg-warning-light">
                                                            <i class="far fa-edit me-2"></i>
                                                        </a>
                                                        <button class="btn btn-sm bg-danger-light guru_delete"
                                                            data-bs-toggle="modal" data-bs-target="#guruDelete"
                                                            data-id="{{ $guru->id }}">
                                                            <i class="far fa-trash-alt me-2"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Modal Delete --}}
                            <div class="modal custom-modal fade" id="guruDelete" role="dialog">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="form-header">
                                                <h3>Hapus Guru</h3>
                                                <p>Yakin ingin menghapus data ini?</p>
                                            </div>
                                            <div class="modal-btn delete-action">
                                                <form action="{{ route('guru.delete') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" id="delete_guru_id">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <button type="submit" class="btn btn-primary">Hapus</button>
                                                        </div>
                                                        <div class="col-6">
                                                            <a href="#" class="btn btn-primary"
                                                                data-bs-dismiss="modal">Batal</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End Modal --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('script')
        <script>
            $(document).on('click', '.guru_delete', function () {
                var id = $(this).data('id');
                $('#delete_guru_id').val(id);
            });
        </script>
    @endsection

@endsection
@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Daftar Nilai Siswa</h3>
                    </div>
                </div>
            </div>

            {{-- Notifikasi --}}
            {!! Toastr::message() !!}

            @php $role = Session::get('role_name'); @endphp

            @if ($role === 'Teachers')
                <div class="mb-3">
                    <a href="{{ route('nilai.report.guru') }}" class="btn btn-primary">
                        <i class="fas fa-file-alt"></i> Laporan Nilai
                    </a>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-table comman-shadow">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-center mb-0 datatable table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Siswa</th>
                                            <th>Guru</th>
                                            <th>Nilai</th>
                                            <th>Keterangan</th>
                                            <th>Sikap</th>
                                            <th>Tahun Ajaran</th>
                                            <th class="text-end">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($nilaiList as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->student->first_name }} {{ $item->student->last_name }}</td>
                                                <td>{{ $item->guru->nama_guru }}</td>
                                                <td>{{ $item->nilai }}</td>
                                                <td>{{ $item->keterangan_nilai }}</td>
                                                <td>{{ $item->sikap }}</td>
                                                <td>{{ $item->tahun_ajaran }}</td>
                                                @php $role = Session::get('role_name'); @endphp

                                                <td class="text-end">
                                                    <div class="actions">
                                                        @if ($role === 'Teachers')
                                                            <a href="{{ route('nilai.edit', $item->id) }}" class="btn btn-sm bg-warning-light me-2">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button type="button" class="btn btn-sm bg-danger-light nilai_delete"
                                                                data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#deleteNilaiModal">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
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

            {{-- Modal Hapus --}}
            <div class="modal custom-modal fade" id="deleteNilaiModal" role="dialog">
                <div class="modal-dialog modal-dialog-centered">
                    <form method="POST" action="{{ route('nilai.delete') }}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Hapus Nilai</h3>
                                    <p>Yakin ingin menghapus data ini?</p>
                                </div>
                                <input type="hidden" name="id" id="delete_id">
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary">Hapus</button>
                                        </div>
                                        <div class="col-6">
                                            <a href="#" data-bs-dismiss="modal" class="btn btn-secondary">Batal</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    @section('script')
        <script>
            $(document).on('click', '.nilai_delete', function () {
                let id = $(this).data('id');
                $('#delete_id').val(id);
            });
        </script>
    @endsection

@endsection
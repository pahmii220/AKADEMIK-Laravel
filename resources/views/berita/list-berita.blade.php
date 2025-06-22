@extends('layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <h3 class="page-title">Daftar Berita</h3>
            </div>

            {{-- Tampilkan pesan sukses --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card">
                <div class="card-body">
                    <a href="{{ route('berita.create') }}" class="btn btn-primary mb-3">+ Tambah Berita</a>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Isi Singkat</th>
                                    <th>Gambar</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($berita as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->judul }}</td>
                                        <td>{!! Str::limit(strip_tags($item->isi), 50) !!}</td>
                                        <td>
                                            @if ($item->gambar)
                                         <img src="{{ asset('uploads/berita/' . $item->gambar)}}" alt="Gambar" width="200">

                                            @else
                                                <small>Tidak ada</small>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="actions">
                                                <a href="{{ route('berita.edit', $item->id) }}" class="btn btn-sm bg-danger-light" title="Edit">
                                                    <i class="far fa-edit me-2"></i>
                                                </a>

                                                <form action="{{ route('berita.delete', $item->id) }}" method="POST" style="display:inline;"
                                                    onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm bg-danger-light" title="Hapus">
                                                        <i class="far fa-trash-alt me-2"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada berita.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
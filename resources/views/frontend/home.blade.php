@extends('layouts.frontend')

@section('title', 'Beranda')

@section('content')
        {{-- Hero Section --}}
        <div class="bg-primary text-white py-5 text-center">
            <div class="container">
                <h1 class="display-5 fw-bold">Selamat Datang di SMKN 3 Banjarmasin</h1>
                <p class="lead">Sekolah Unggulan, Berkarakter, dan Berprestasi</p>
            </div>
        </div>

        {{-- Berita Terbaru --}}
    {{-- Berita Terbaru --}}
    <div  style="background-image: url(https://smkn3banjarmasin.sch.id/front/img/courses/courses_bg.png);">>
        <div class="container">
            <h2 class="mb-4 text-center text-white">Latest News </h2><br>

            <div class="row">
                @forelse($berita as $item)
                    <div class="col-xl-4 col-lg-4 col-md-6 mb-4">
                        <div class="card h-100 shadow-sm" style="padding: 15px;">
                            <a href="{{ route('berita.show', $item->id) }}">
                                <img src="{{ asset('uploads/berita/' . $item->gambar) }}" alt="{{ $item->judul }}"
                                    class="card-img-top mb-3" style="height: 250px; object-fit: cover;">
                            </a>

                            <div class="card-body d-flex flex-column">
                                {{-- Tanggal --}}
                                <span class="text-muted small mb-2">
                                    {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, d F Y') }}
                                </span>

                                {{-- Judul --}}
                                <h5 class="card-title mb-2">
                                    <a href="{{ route('berita.show', $item->id) }}" class="text-dark">
                                        {{ \Illuminate\Support\Str::limit($item->judul, 60) }}
                                    </a>
                                </h5>

                                {{-- Isi ringkas --}}
                                <p class="card-text flex-grow-1">
                                    {!! \Illuminate\Support\Str::limit(strip_tags($item->isi), 100) !!}
                                </p>

                                {{-- Tombol --}}
                                <a href="{{ route('berita.show', $item->id) }}" class="btn btn-outline-primary btn-sm mt-auto">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-white">Belum ada berita yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection
        @extends('layouts.master')


        @section('content')
                <div class="page-wrapper">
                    <div class="content container-fluid">
                        <div class="page-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="page-title">Edit Berita</h3>
                                    <ul class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Edit Berita</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('berita.update', $berita->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            {{-- Judul --}}
                                            <div class="form-group">
                                                <label>Judul</label>
                                                <input type="text" class="form-control" name="judul" value="{{ $berita->judul }}"
                                                    required>
                                            </div>

                                            {{-- Isi --}}
                                            <div class="form-group">
                                                <label>Isi</label>
                                                <textarea name="isi" rows="6" class="form-control"
                                                    required>{{ $berita->isi }}</textarea>
                                            </div>

            {{-- Gambar (Upload Baru) --}}
            <div class="form-group">
                <label>Gambar (Kosongkan jika tidak diganti)</label>
                <input type="file" name="gambar" class="form-control" id="gambarInput" accept="image/*"
                    onchange="previewGambar(event)">
            </div>


                {{-- Preview Gambar Lama --}}
                <div class="mt-2">
                    <img id="gambarPreview" src="{{ $berita->gambar ? asset('uploads/berita/' . $berita->gambar) : '#' }}"
                        alt="Gambar Preview" width="150" class="{{ $berita->gambar ? '' : 'd-none' }}">           
                </div> <br>



                                            {{-- Tombol --}}
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                <a href="{{ route('berita.list') }}" class="btn btn-secondary">Kembali</a>
                                            </div>
                                        </form>

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

        @push('scripts')
            <script>
                function previewGambar(event) {
                    const input = event.target;
                    const preview = document.getElementById('gambarPreview');

                    if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            preview.src = e.target.result;
                            preview.classList.remove('d-none');
                        };
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>
        @endpush
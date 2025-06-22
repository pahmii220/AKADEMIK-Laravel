<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Brian2694\Toastr\Facades\Toastr;

class BeritaController extends Controller
{
    /** Menampilkan halaman index berita */
    public function list()
    {
        $berita = Berita::latest()->get();
        return view('berita.list-berita', compact('berita'));
    }

    /** Form tambah berita */
    public function create()
    {
        return view('berita.add-berita');
    }

    /** Simpan berita baru */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/berita'), $filename);
            $gambar = $filename;
        } else {
            $gambar = null;
        }

        Berita::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'gambar' => $gambar,
        ]);

        Toastr::success('Berita berhasil ditambahkan');
        return redirect()->route('berita.list');
    }

    /** Edit form */
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.edit-berita', compact('berita'));
    }

    /** Update berita */
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar))) {
                unlink(public_path('uploads/berita/' . $berita->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/berita'), $filename);
            $berita->gambar = $filename;
        }

        $berita->update([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'gambar' => $berita->gambar,
        ]);

        Toastr::success('Berita berhasil diperbarui');
        return redirect()->route('berita.list');
    }

    /** Hapus berita */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->gambar && file_exists(public_path('uploads/berita/' . $berita->gambar))) {
            unlink(public_path('uploads/berita/' . $berita->gambar));
        }

        $berita->delete();

        Toastr::success('Berita berhasil dihapus');
        return redirect()->route('berita.list');
    }

    /** Frontend: daftar berita */
    public function index()
    {
        $berita = Berita::latest()->paginate(6);
        return view('frontend.berita.index', compact('berita'));
    }

    /** Frontend: detail berita */
    public function show($id)
    {
        $item = Berita::findOrFail($id);
        return view('frontend.berita.show', compact('item'));
    }

    /** Ajax DataTables */
    public function getDataList()
    {
        $beritas = Berita::latest()->get();
        return datatables()->of($beritas)
            ->addColumn('action', function ($data) {
                return '
                    <a href="' . route('berita.edit', $data->id) . '" class="btn btn-sm btn-warning">Edit</a>
                    <form action="' . route('berita.delete', $data->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button class="btn btn-sm btn-danger" onclick="return confirm(\'Hapus?\')">Hapus</button>
                    </form>
                ';
            })
            ->make(true);
    }
}

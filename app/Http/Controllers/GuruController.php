<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use PDF;

class GuruController extends Controller
{
    // Tampilkan halaman tambah guru
    public function create()
    {
        return view('guru.add-guru');
    }

    // Simpan data guru
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:guru,nip|string|max:20',
            'nama_guru' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string|max:50',
            'status_pegawai' => 'required|string|max:100',
            'keahlian_utama' => 'required|string|max:255',
            'pendidikan_terakhir' => 'required|string|max:100',
            'tahun_aktif_kerja' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
        ]);

        try {
            Guru::create($request->all());
            Toastr::success('Data guru berhasil ditambahkan.', 'Sukses');
            return redirect()->route('guru.list');
        } catch (\Exception $e) {
            \Log::error($e);
            Toastr::error('Gagal menyimpan data guru', 'Gagal');
            return back()->withInput();
        }
    }

    // Tampilkan semua data guru
    public function index()
    {
        $data = Guru::all();
        return view('guru.list-guru', compact('data'));
    }
    

    // Tampilkan form edit
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.edit-guru', compact('guru'));

    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);
    
        $request->validate([
            'nip' => 'required',
            'nama_guru' => 'required',
            'jenis_kelamin' => 'required',
            'tanggal_lahir' => 'required|date',
            // validasi lain
        ]);
    
        $guru->update([
            'nip' => $request->nip,
            'nama_guru' => $request->nama_guru,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'status_pegawai' => $request->status_pegawai,
            'keahlian_utama' => $request->keahlian_utama,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
        ]);
        Toastr::success('Data guru berhasil diperbarui.', 'Sukses');
        return redirect()->route('guru.list')->with('success', 'Data guru berhasil diperbarui.');
    }
    
    // Hapus data guru
    public function destroy(Request $request)
    {
        Guru::destroy($request->id);
        Toastr::success('Data guru berhasil dihapus');
        return redirect()->route('guru.list');
    }
    

    public function showReportFilter()
{
    return view('guru.report-filter');
}

public function viewReport(Request $request)
{
    $query = Guru::query();

    if ($request->filled('pendidikan')) {
        $query->where('pendidikan_terakhir', $request->pendidikan);
    }

    if ($request->filled('status_pegawai')) {
        $query->where('status_pegawai', $request->status_pegawai);
    }

    $guruList = $query->get();

    return view('guru.report-filter', compact('guruList'));
}

public function generateReportPdf(Request $request)
{
    $query = Guru::query();

    if ($request->filled('pendidikan')) {
        $query->where('pendidikan_terakhir', $request->pendidikan);
    }

    if ($request->filled('status_pegawai')) {
        $query->where('status_pegawai', $request->status_pegawai);
    }

    $guruList = $query->get();

    $pdf = PDF::loadView('guru.report', compact('guruList'))->setPaper('a4', 'landscape');
    return $pdf->download('laporan_guru.pdf');
}
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Jurusan;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Guru;
use PDF;

class JurusanController extends Controller
{
    public function __construct()
    {
        // Terapkan middleware otentikasi hanya pada metode yang memerlukan otentikasi, kecuali 'index'
        $this->middleware('auth:sanctum', ['except' => ['index']]);
    }

    /** API: Ambil semua data jurusan */
    public function index()
    {
        $jurusan = Jurusan::all();
        return response()->json($jurusan);
    }

    /** View: Daftar jurusan */
    public function jurusanList()
    {
        $jurusanList = Jurusan::all();
        return view('jurusan.jurusan_list', compact('jurusanList'));
    }

    /** View: Tambah jurusan */
    public function jurusanAdd()
    {
        return view('jurusan.jurusan_add');
    }

    /** Simpan data baru */
    public function saveRecord(Request $request)
    {
        $request->validate([
            'kode_jurusan'   => 'required|string|unique:jurusan,kode_jurusan',
            'nama_jurusan'   => 'required|string',
            'singkatan'      => 'nullable|string',
            'kepala_jurusan' => 'nullable|string',
        ]);
        
        DB::beginTransaction();
        try {
            $jurusan = new Jurusan;
            $jurusan->kode_jurusan   = $request->kode_jurusan;
            $jurusan->nama_jurusan   = $request->nama_jurusan;
            $jurusan->singkatan      = $request->singkatan;
            $jurusan->kepala_jurusan = $request->kepala_jurusan;
            $jurusan->save();

            Toastr::success('Data jurusan berhasil ditambahkan', 'Success');
            DB::commit();
            return redirect()->back();
        } catch(\Exception $e) {
            \Log::error($e);
            DB::rollback();
            Toastr::error('Gagal menambahkan data jurusan', 'Error');
            return redirect()->back();
        }
    }

    /** View: Edit jurusan */
    public function jurusanEdit($id)
    {
        $jurusanEdit = Jurusan::findOrFail($id);
        return view('jurusan.jurusan_edit', compact('jurusanEdit'));
    }

    /** Update data jurusan */
    public function updateRecord(Request $request)
    {
        $request->validate([
            'kode_jurusan'   => 'required|string',
            'nama_jurusan'   => 'required|string',
            'singkatan'      => 'nullable|string',
            'kepala_jurusan' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $data = [
                'kode_jurusan'   => $request->kode_jurusan,
                'nama_jurusan'   => $request->nama_jurusan,
                'singkatan'      => $request->singkatan,
                'kepala_jurusan' => $request->kepala_jurusan,
            ];

            Jurusan::where('id', $request->id)->update($data);

            Toastr::success('Data jurusan berhasil diperbarui', 'Success');
            DB::commit();
            return redirect()->route('jurusan.list');
        } catch(\Exception $e) {
            \Log::error($e);
            DB::rollback();
            Toastr::error('Gagal memperbarui data jurusan', 'Error');
            return redirect()->route('jurusan.list');
        }
    }

    /** Hapus data jurusan */
    public function deleteRecord(Request $request)
    {
        DB::beginTransaction();
        try {
            Jurusan::where('id', $request->id)->delete();
            DB::commit();
            Toastr::success('Data jurusan berhasil dihapus', 'Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Gagal menghapus data jurusan', 'Error');
            return redirect()->back();
        }
    }

    public function showReportFilter()
{
    return view('jurusan.report-filter');
}

public function viewReport(Request $request)
{
    $query = Jurusan::query();

    if ($request->filled('kepala_jurusan')) {
        $query->where('kepala_jurusan', 'LIKE', '%' . $request->kepala_jurusan . '%');
    }

    if ($request->filled('singkatan')) {
        $query->where('singkatan', $request->singkatan);
    }

    $jurusanList = $query->get();

    return view('jurusan.report-filter', compact('jurusanList'));
}

public function generateReportPdf(Request $request)
{
    $query = Jurusan::query();

    if ($request->filled('kepala_jurusan')) {
        $query->where('kepala_jurusan', 'LIKE', '%' . $request->kepala_jurusan . '%');
    }

    if ($request->filled('singkatan')) {
        $query->where('singkatan', $request->singkatan);
    }

    $jurusanList = $query->get();

    $pdf = PDF::loadView('jurusan.report', compact('jurusanList'))->setPaper('a4', 'landscape');

    return $pdf->download('laporan_jurusan.pdf');
}



public function create()
{
    $guruList = Guru::all();
    return view('jurusan.create', compact('guruList'));
}

public function edit($id)
{
    $jurusan = Jurusan::findOrFail($id);
    $guruList = Guru::all();
    return view('jurusan.edit', compact('jurusan', 'guruList'));
}

}

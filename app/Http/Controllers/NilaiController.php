<?php

    namespace App\Http\Controllers;
    use App\Models\Nilai;
    use App\Models\Student;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Session;
    use Brian2694\Toastr\Facades\Toastr;
    use PDF;


    class NilaiController extends Controller
    {
        public function create()
        {
            $students = Student::all();
            return view('nilai.create', compact('students'));
        }


        public function store(Request $request)
        {
            if (Session::get('role_name') !== 'Teachers') {
                Toastr::error('Hanya guru yang dapat menyimpan nilai!', 'Akses Ditolak');
                return redirect()->route('nilai.list');
            }
        
            $request->validate([
                'student_id' => 'required|exists:students,id',
                'nilai' => 'required|numeric|min:0|max:100',
                'keterangan_nilai' => 'nullable|string|max:255',
                'sikap' => 'nullable|string|max:255',
                'tahun_ajaran' => 'required|string|max:20',
            ]);
        
            Nilai::create([
                'student_id' => $request->student_id,
                'guru_id' => auth()->user()->id,
                'nilai' => $request->nilai,
                'keterangan_nilai' => $request->keterangan_nilai,
                'sikap' => $request->sikap,
                'tahun_ajaran' => $request->tahun_ajaran,
            ]);
        
            return redirect()->route('nilai.list')->with('success', 'Nilai berhasil disimpan.');
        }
        

        public function index()
        {
            $nilaiList = \App\Models\Nilai::with(['student', 'guru'])->get();
            return view('nilai.list-nilai', compact('nilaiList'));
        }
        

        public function edit($id)
        {
            if (Session::get('role_name') !== 'Teachers') {
                Toastr::error('Hanya guru yang dapat mengedit nilai!', 'Akses Ditolak');
                return redirect()->route('nilai.list');
            }
        
            $nilai = Nilai::findOrFail($id);
            $students = Student::all();
            return view('nilai.edit-nilai', compact('nilai', 'students'));
        }
        

        public function update(Request $request, $id)
        {
            if (Session::get('role_name') !== 'Teachers') {
                Toastr::error('Hanya guru yang dapat mengupdate nilai!', 'Akses Ditolak');
                return redirect()->route('nilai.list');
            }
        
            $request->validate([
                'student_id' => 'required|exists:students,id',
                'nilai' => 'required|numeric|min:0|max:100',
                'keterangan_nilai' => 'nullable|string|max:255',
                'sikap' => 'nullable|string|max:255',
                'tahun_ajaran' => 'required|string|max:20',
            ]);
        
            $nilai = Nilai::findOrFail($id);
            $nilai->update($request->all());
        
            return redirect()->route('nilai.list')->with('success', 'Nilai berhasil diperbarui.');
        }
        

        public function destroy(Request $request)
        {
            if (Session::get('role_name') !== 'Teachers') {
                Toastr::error('Hanya guru yang dapat menghapus nilai!', 'Akses Ditolak');
                return redirect()->route('nilai.list');
            }
        
            Nilai::destroy($request->id);
            Toastr::success('Nilai berhasil dihapus');
            return redirect()->route('nilai.list');
        }
        
        public function reportGuru()
{
    $guruId = session('guru_id');

    if (!$guruId) {
        abort(403, 'Guru tidak ditemukan dalam sesi login.');
    }

    $nilai = \App\Models\Nilai::with(['student', 'guru'])
                ->where('guru_id', $guruId)
                ->get();

    return view('nilai.report-guru', compact('nilai'));
}


    }

<?php

namespace App\Http\Controllers;

use PDF;
use DB;
use App\Models\Student;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Jurusan;

class StudentController extends Controller
{
    /** index page student list */
    public function student()
    {
        $studentList = Student::all();
        return view('student.student', compact('studentList'));
    }

    /** index page student grid */
    public function studentGrid()
    {
        $studentList = Student::all();
        return view('student.student-grid', compact('studentList'));
    }

    /** student add page */
    public function studentAdd()
    {

        $jurusanList = Jurusan::all();
        return view('student.add-student', compact('jurusanList'));
    }

    /** student save record */
    public function studentSave(Request $request)
    {
        $request->validate([
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'jenis_kelamin' => 'required|not_in:0',
            'date_of_birth' => 'required|string',
            'roll'          => 'required|string',
            'blood_group'   => 'required|string',
            'religion'      => 'required|string',
            'email'         => 'required|email',
            'class'         => 'required|string',
            'jurusan'       => 'required|string',
            'section'       => 'required|string',
            'admission_id'  => 'required|string',
            'phone_number'  => 'required',
        ]);

        DB::beginTransaction();
        try {
            $student = new Student;
            $student->first_name    = $request->first_name;
            $student->last_name     = $request->last_name;
            $student->jenis_kelamin = $request->jenis_kelamin;
            $student->date_of_birth = $request->date_of_birth;
            $student->roll          = $request->roll;
            $student->blood_group   = $request->blood_group;
            $student->religion      = $request->religion;
            $student->email         = $request->email;
            $student->class         = $request->class;
            $student->jurusan       = $request->jurusan;
            $student->section       = $request->section;
            $student->admission_id  = $request->admission_id;
            $student->phone_number  = $request->phone_number;

            $student->save();

            Toastr::success('Data Siswa Berhasil di Simpan :)', 'Succes');
            DB::commit();
            return redirect()->route('student');

        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data Siswa Gagal Disimpan :(', 'Error');
            return redirect()->back();
        }
    }

    /** view for edit student */
    public function studentEdit($id)
    {
        $studentEdit = Student::findOrFail($id); 
        $jurusanList = Jurusan::all(); // ambil semua data jurusan
    
        return view('student.edit-student', compact('studentEdit', 'jurusanList'));

    }
    

    /** update record */
    public function studentUpdate(Request $request)
    {
        $request->validate([
            'id'            => 'required|integer',
            'first_name'    => 'required|string',
            'last_name'     => 'required|string',
            'jenis_kelamin' => 'required|not_in:0',
            'date_of_birth' => 'required|string',
            'roll'          => 'required|string',
            'blood_group'   => 'required|string',
            'religion'      => 'required|string',
            'email'         => 'required|email',
            'class'         => 'required|string',
            'jurusan'       => 'required|string',
            'section'       => 'required|string',
            'admission_id'  => 'required|string',
            'phone_number'  => 'required',
        ]);

        DB::beginTransaction();
        try {
            $student = Student::find($request->id);

            if (!$student) {
                Toastr::error('Student not found.', 'Error');
                return redirect()->back();
            }

            $student->first_name    = $request->first_name;
            $student->last_name     = $request->last_name;
            $student->jenis_kelamin = $request->jenis_kelamin;
            $student->date_of_birth = $request->date_of_birth;
            $student->roll          = $request->roll;
            $student->blood_group   = $request->blood_group;
            $student->religion      = $request->religion;
            $student->email         = $request->email;
            $student->class         = $request->class;
            $student->jurusan       = $request->jurusan;
            $student->section       = $request->section;
            $student->admission_id  = $request->admission_id;
            $student->phone_number  = $request->phone_number;

            $student->save();

            Toastr::success('Update Siwa Berhasil :)','Succes',);
            DB::commit();
            return redirect()->route('student');

        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Update Siwa Gagal.', 'Error');
            return redirect()->route('student');
        }
        if (auth()->user()->role_name !== 'admin') {
            abort(403, 'Hanya admin yang dapat mengupdate data siswa.');
        }

    }

    /** student delete */
    public function studentDelete(Request $request)
    {
        DB::beginTransaction();
        try {
            if (!empty($request->id)) {
                Student::destroy($request->id);
                DB::commit();
                Toastr::success('Data Siswa Berhasil di Hapus :)', 'Success');
                return redirect()->route('student');
            }

        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Data Siswa Gagal di Hapus :(', 'Error');
            return redirect()->route('student');
        }

        if (auth()->user()->role_name !== 'admin') {
            abort(403, 'Hanya admin yang dapat menghapus data siswa.');
        }
    }

    /** student profile page */
    public function studentProfile($id)
    {
        $studentProfile = Student::where('id', $id)->first();
        return view('student.student-profile', compact('studentProfile'));
    }

    // Menampilkan form + hasil filter
    public function showReportFilter(Request $request)
    {
        $jurusanList = Jurusan::all();
        $students = collect(); // default kosong
    
        // Jika ada filter atau user klik tombol tampilkan
        if ($request->has('jurusan') || $request->has('kelas')) {
            $query = Student::query();
    
            if ($request->jurusan) {
                $query->where('jurusan', $request->jurusan);
            }
    
            if ($request->kelas) {
                $query->where('class', $request->kelas);
            }
    
            $students = $query->get();
        }
    
        // Jika user mengakses halaman tanpa filter, tampilkan semua data
        if (!$request->has('jurusan') && !$request->has('kelas') && $request->all()) {
            $students = Student::all();
        }
    
        return view('student.report-filter', compact('jurusanList', 'students'));
    }
    
    
    // Generate PDF
    public function generateReportPdf(Request $request)
    {
        $query = Student::query();

        if ($request->filled('jurusan')) {
            $query->where('jurusan', $request->jurusan);
        }

        if ($request->filled('class')) {
            $query->where('class', $request->class);
        }

        $students = $query->get();

        $pdf = PDF::loadView('student.report', compact('students'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download('laporan_data_siswa.pdf');
    }
    public function studentReport()
    {
        $students = Student::all(); // atau filter sesuai kebutuhan
        return view('student.report', compact('students'));
    }
    

    
}

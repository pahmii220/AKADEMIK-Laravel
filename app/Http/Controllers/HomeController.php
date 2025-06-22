<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Student; 
use App\Models\Jurusan;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    /** home dashboard */
    public function index()
    {
        // Ambil semua nama jurusan unik dari tabel students
        $jurusanLabels = Student::select('jurusan')->distinct()->pluck('jurusan')->toArray();
    
        $jumlahLaki = [];
        $jumlahPerempuan = [];
    
        foreach ($jurusanLabels as $jurusan) {
            $jumlahLaki[] = Student::where('jurusan', $jurusan)->where('jenis_kelamin', 'Laki-Laki')->count();
            $jumlahPerempuan[] = Student::where('jurusan', $jurusan)->where('jenis_kelamin', 'Perempuan')->count();
        }
    
        // Jumlah keseluruhan
        $jumlahGuru = Guru::count();
        $jumlahSiswaLaki = Student::where('jenis_kelamin', 'Laki-Laki')->count();
        $jumlahSiswaPerempuan = Student::where('jenis_kelamin', 'Perempuan')->count();
        $jumlahJurusan = count($jurusanLabels);
        $jumlahSiswa = Student::count(); // total semua siswa

    
        return view('dashboard.home', compact(
            'jurusanLabels',
            'jumlahLaki',
            'jumlahPerempuan',
            'jumlahGuru',
            'jumlahSiswaLaki',
            'jumlahSiswaPerempuan',
            'jumlahJurusan',
             'jumlahSiswa'
        ));
    }

    /** profile user */ 
    public function userProfile()
    {
        return view('dashboard.profile');
    }

    /** teacher dashboard */
    public function teacherDashboardIndex()
    {
        return view('dashboard.teacher_dashboard');
    }

    /** student dashboard */
    public function studentDashboardIndex()
    {
        return view('dashboard.student_dashboard');
    }
}

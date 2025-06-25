<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\NilaiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** for side bar menu active */
function set_active( $route ) {
    if( is_array( $route ) ){
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}



Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware'=>'auth'],function()
{
    Route::get('home',function()
    {
        return view('home');
    });
    // Route::get('home',function()
    // {
    //     return view('home');
    // });
});

Auth::routes();
Route::group(['namespace' => 'App\Http\Controllers\Auth'],function()
{
    // ----------------------------login ------------------------------//
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate');
        Route::get('/logout', 'logout')->name('logout');
        Route::post('change/password', 'changePassword')->name('change/password');
    });

    // ----------------------------- register -------------------------//
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::post('/register','storeUser')->name('register');    
    });
});

Route::group(['namespace' => 'App\Http\Controllers'],function()
{
    // -------------------------- main dashboard ----------------------//
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->middleware('auth')->name('home');
        Route::get('user/profile/page', 'userProfile')->middleware('auth')->name('user/profile/page');
        Route::get('teacher/dashboard', 'teacherDashboardIndex')->middleware('auth')->name('teacher/dashboard');
        Route::get('student/dashboard', 'studentDashboardIndex')->middleware('auth')->name('student/dashboard');
    });

    // ----------------------------- user controller ---------------------//
    Route::controller(UserManagementController::class)->group(function () {
        Route::get('list/users', 'index')->middleware('auth')->name('list/users');
        Route::post('change/password', 'changePassword')->name('change/password');
        Route::get('view/user/edit/{id}', 'userView')->middleware('auth');
        Route::post('user/update', 'userUpdate')->name('user/update');
        Route::post('user/delete', 'userDelete')->name('user/delete');
        Route::get('get-users-data', 'getUsersData')->name('get-users-data'); /** get all data users */

    });

    // ------------------------ setting -------------------------------//
    // Route::controller(Setting::class)->group(function () {
    //     Route::get('setting/page', 'index')->middleware('auth')->name('setting/page');
    // });
    
    Route::get('/', [FrontendController::class, 'index'])->name('home');

    // ------------------------ information atau berita-------------------------------//
    Route::prefix('admin/berita')->group(function () {
        Route::get('/', [BeritaController::class, 'list'])->name('berita.list');
        Route::get('/create', [BeritaController::class, 'create'])->name('berita.create');
        Route::post('/store', [BeritaController::class, 'store'])->name('berita.store');
        Route::get('/edit/{id}', [BeritaController::class, 'edit'])->name('berita.edit');
        Route::put('/update/{id}', [BeritaController::class, 'update'])->name('berita.update');
        Route::delete('/delete/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');
        Route::delete('admin/berita/delete/{id}', [BeritaController::class, 'destroy'])->name('berita.delete');


    });
    
    // Frontend halaman depan
    Route::get('/berita', [BeritaController::class, 'index'])->name('frontend.berita.index');
    Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('frontend.berita.show');
    Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');
    

                // Nilai controller 
    Route::middleware('auth')->group(function () {
        Route::get('/nilai/tambah', [NilaiController::class, 'create'])->name('nilai.create');
        Route::post('/nilai/simpan', [NilaiController::class, 'store'])->name('nilai.store');
        Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.index');
        Route::get('/nilai', [NilaiController::class, 'index'])->name('nilai.list');
        Route::get('/nilai/edit/{id}', [NilaiController::class, 'edit'])->name('nilai.edit');
        Route::post('/nilai/delete', [NilaiController::class, 'destroy'])->name('nilai.delete');
        Route::put('/nilai/update/{id}', [NilaiController::class, 'update'])->name('nilai.update');
        Route::get('/teachers/nilai/report', [NilaiController::class, 'reportGuru'])->name('nilai.report.guru');

    });

    // ------------------------ student -------------------------------//
    Route::controller(StudentController::class)->group(function () {
        Route::get('student', 'student')->middleware('auth')->name('student'); // ✅ Ini route utama daftar siswa
        Route::get('student/list', 'student')->middleware('auth')->name('student/list'); // opsional
        Route::get('student/grid', 'studentGrid')->middleware('auth')->name('student/grid');
        Route::post('student/add/save', 'studentSave')->name('student/add/save'); // ✅ akan dipakai untuk simpan siswa
        Route::get('student/edit/{id}', 'studentEdit')->name('student/edit'); // agar bisa dipanggil via name('student/edit')
        Route::post('student/update', 'studentUpdate')->name('student/update');
        Route::get('student/add/page', 'studentAdd')->middleware('auth')->name('student/add/page');
        Route::post('student/delete', 'studentDelete')->name('student/delete');

        //controllernya di atas page //
        Route::get('/student/report/filter', [StudentController::class, 'showReportFilter'])->name('student.report.filter');
        Route::get('/student/report/view', [StudentController::class, 'studentReport'])->name('student.report.view');
        Route::get('/student/report/pdf', [StudentController::class, 'generateReportPdf'])->name('student.report.pdf');
    });

    // ------------------------ Guru -------------------------------//
    Route::prefix('guru')->group(function () {
    Route::get('/list', [GuruController::class, 'index'])->name('guru.list');
    Route::get('/add', [GuruController::class, 'create'])->name('guru.create');
    Route::get('/guru/add', [GuruController::class, 'guruAdd'])->name('guru.add');
    Route::post('/save', [GuruController::class, 'store'])->name('guru.save');
    Route::get('/edit/{id}', [GuruController::class, 'edit'])->name('guru.edit');
    Route::put('/guru/update/{id}', [GuruController::class, 'update'])->name('guru.update');
    Route::post('/guru/delete', [GuruController::class, 'destroy'])->name('guru.delete');
    Route::get('guru/report/filter', [GuruController::class, 'showReportFilter'])->name('guru.report.filter');
    Route::get('guru/report/view', [GuruController::class, 'viewReport'])->name('guru.report.view');
    Route::get('guru/report/pdf', [GuruController::class, 'generateReportPdf'])->name('guru.report.pdf');

});

// Untuk guru hanya boleh lihat data
Route::middleware(['auth', 'role:Teachers'])->group(function () {
    Route::get('/siswa', [StudentController::class, 'index']);
    Route::get('/jurusan', [JurusanController::class, 'index']);
    Route::get('/berita', [BeritaController::class, 'index']);
});

        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');


    

    // ----------------------- department -----------------------------//
    Route::controller(DepartmentController::class)->group(function () {
        Route::get('department/list/page', 'departmentList')->middleware('auth')->name('department/list/page'); // department/list/page
        Route::get('department/add/page', 'indexDepartment')->middleware('auth')->name('department/add/page'); // page add department
        Route::get('department/edit/{department_id}', 'editDepartment'); // page add department
        Route::post('department/save', 'saveRecord')->middleware('auth')->name('department/save'); // department/save
        Route::post('department/update', 'updateRecord')->middleware('auth')->name('department/update'); // department/update
        Route::post('department/delete', 'deleteRecord')->middleware('auth')->name('department/delete'); // department/delete
        Route::get('get-data-list', 'getDataList')->name('get-data-list'); // get data list

    });

    // ----------------------- Jurusan -----------------------------//
    Route::get('/jurusan', [JurusanController::class, 'jurusanList'])->name('jurusan.list');
    Route::get('/jurusan/create', [JurusanController::class, 'jurusanAdd'])->name('jurusan.create');
    Route::post('/jurusan/save', [JurusanController::class, 'saveRecord'])->name('jurusan.save');
    Route::get('/jurusan/edit/{id}', [JurusanController::class, 'jurusanEdit'])->name('jurusan.edit');
    Route::post('/jurusan/update', [JurusanController::class, 'updateRecord'])->name('jurusan.update');
    Route::post('/jurusan/delete', [JurusanController::class, 'deleteRecord'])->name('jurusan.delete');
    Route::get('jurusan/report/filter', [JurusanController::class, 'showReportFilter'])->name('jurusan.report.filter');
    Route::get('jurusan/report/view', [JurusanController::class, 'viewReport'])->name('jurusan.report.view');
    Route::get('jurusan/report/pdf', [JurusanController::class, 'generateReportPdf'])->name('jurusan.report.pdf');


    // ----------------------- invoice -----------------------------//
    // Route::controller(InvoiceController::class)->group(function () {
    //     Route::get('invoice/list/page', 'invoiceList')->middleware('auth')->name('invoice/list/page'); // subjeinvoicect/list/page
    //     Route::get('invoice/paid/page', 'invoicePaid')->middleware('auth')->name('invoice/paid/page'); // invoice/paid/page
    //     Route::get('invoice/overdue/page', 'invoiceOverdue')->middleware('auth')->name('invoice/overdue/page'); // invoice/overdue/page
    //     Route::get('invoice/draft/page', 'invoiceDraft')->middleware('auth')->name('invoice/draft/page'); // invoice/draft/page
    //     Route::get('invoice/recurring/page', 'invoiceRecurring')->middleware('auth')->name('invoice/recurring/page'); // invoice/recurring/page
    //     Route::get('invoice/cancelled/page', 'invoiceCancelled')->middleware('auth')->name('invoice/cancelled/page'); // invoice/cancelled/page
    //     Route::get('invoice/grid/page', 'invoiceGrid')->middleware('auth')->name('invoice/grid/page'); // invoice/grid/page
    //     Route::get('invoice/add/page', 'invoiceAdd')->middleware('auth')->name('invoice/add/page'); // invoice/add/page
    //     Route::post('invoice/add/save', 'saveRecord')->name('invoice/add/save'); // invoice/add/save
    //     Route::post('invoice/update/save', 'updateRecord')->name('invoice/update/save'); // invoice/update/save
    //     Route::post('invoice/delete', 'deleteRecord')->name('invoice/delete'); // invoice/delete
    //     Route::get('invoice/edit/{invoice_id}', 'invoiceEdit')->middleware('auth')->name('invoice/edit/page'); // invoice/edit/page
    //     Route::get('invoice/view/{invoice_id}', 'invoiceView')->middleware('auth')->name('invoice/view/page'); // invoice/view/page
    //     Route::get('invoice/settings/page', 'invoiceSettings')->middleware('auth')->name('invoice/settings/page'); // invoice/settings/page
    //     Route::get('invoice/settings/tax/page', 'invoiceSettingsTax')->middleware('auth')->name('invoice/settings/tax/page'); // invoice/settings/tax/page
    //     Route::get('invoice/settings/bank/page', 'invoiceSettingsBank')->middleware('auth')->name('invoice/settings/bank/page'); // invoice/settings/bank/page
    // });

    // ----------------------- accounts ----------------------------//
    Route::controller(AccountsController::class)->group(function () {
        Route::get('account/fees/collections/page', 'index')->middleware('auth')->name('account/fees/collections/page'); // account/fees/collections/page
        Route::get('add/fees/collection/page', 'addFeesCollection')->middleware('auth')->name('add/fees/collection/page'); // add/fees/collection
        Route::post('fees/collection/save', 'saveRecord')->middleware('auth')->name('fees/collection/save'); // fees/collection/save
    });
});

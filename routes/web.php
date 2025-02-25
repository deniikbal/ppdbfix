<?php

use App\Http\Controllers\Admin\PaymentController as PaymentControllerAlias;
use App\Http\Controllers\Admin\PrintController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\Student\PaymentController as PaymentControllerAlias1;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\WhatsAppController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('getschoolas', [HomeController::class, 'getschoolas']);
Auth::routes();

Route::get('testing', [\App\Http\Controllers\TestingController::class, 'testing']);
Route::post('sendnotif', [\App\Http\Controllers\TestingController::class, 'sendnotif'])->name('sendnotif');
Route::post('bayar', [\App\Http\Controllers\TestingController::class, 'bayar'])->name('bayar');
Route::post('usernotification', [\App\Http\Controllers\TestingController::class, 'usernotification'])->name('usernotification');
//Route::get('home', [HomeController::class, 'index'])->name('home');
//Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
    //Users
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('userblmbayar', [UserController::class, 'notstudent'])->name('user.blmbayar');
    Route::get('user/{id}/edit', [UserController::class, 'show'])->name('users.show');
    Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('user/{id}', [UserController::class, 'delete'])->name('users.delete');
    Route::post('createusers', [UserController::class, 'store'])->name('users.store');
    Route::put('regisnewuser/{id}', [UserController::class, 'regisnewuser'])->name('regisnewuser');
    //Sekolah
    Route::post('tambahsekolah', [SchoolController::class, 'tambahsekolah'])->name('tambahsekolah');
    Route::delete('schooldelet/{id}', [SchoolController::class, 'schooldelet'])->name('schooldelet');
    Route::get('schooledit/{id}', [SchoolController::class, 'schooledit'])->name('schooledit');
    Route::put('schoolupdate/{id}', [SchoolController::class, 'schoolupdate'])->name('schoolupdate');
    Route::get('import', [SchoolController::class, 'import'])->name('import');
    Route::get('sekolah', [SchoolController::class, 'index'])->name('schools.index');
    //Student
    Route::get('allstudent', [AdminStudentController::class, 'index'])->name('allstudent');
    Route::get('showstudent/{id}/edit', [AdminStudentController::class, 'showtudent'])->name('showstudent');
    Route::delete('deletestudent/{id}', [AdminStudentController::class, 'destroy'])->name('deletestudent');
    Route::put('updatestudentadmin/{uuid}', [AdminStudentController::class, 'updatestudentadmin'])->name('updatestudentadmin');
    Route::post('createstudentadmin', [AdminStudentController::class, 'createstudentadmin'])->name('createstudentadmin');
    Route::get('export', [AdminStudentController::class, 'export'])->name('export');
    Route::put('regisnewstudent/{id}', [AdminStudentController::class, 'regisnewstudent'])->name('regisnewstudent');
    Route::get('viewstudent/{id}', [AdminStudentController::class, 'viewstudent'])->name('viewstudent');
    //Print
    Route::get('surat/{id}', [SuratController::class, 'surat'])->name('surat');
    Route::post('updatesurat/{id}', [PrintController::class, 'updatesurat'])->name('updatesurat');

    //WhatsApp
    Route::get('wa', [WhatsAppController::class, 'index'])->name('wa.index');
    Route::post('wastore', [WhatsAppController::class, 'wastore'])->name('wa.store');
    Route::post('deletewa/{id}', [WhatsAppController::class, 'deletewa'])->name('deletewa');
    Route::post('waupdate/{id}', [WhatsAppController::class, 'waupdate'])->name('waupdate');
    //PAYMENT
    Route::get('adminpayment', [PaymentControllerAlias::class, 'index'])->name('adminpayment');
    Route::get('editpaymentadmin/{id}', [PaymentControllerAlias::class, 'editpaymentadmin'])->name('editpaymentadmin');
    Route::put('updatepayadmin/{id}', [PaymentControllerAlias::class, 'updatepayadmin'])->name('updatepayadmin');
    Route::put('verifikasipay/{id}', [PaymentControllerAlias::class, 'verifikasipay'])->name('verifikasipay');
    Route::delete('deletepayment/{id}', [PaymentControllerAlias::class, 'deletepayment'])->name('deletepayment');
    //Testing
    Route::get('testing', [\App\Http\Controllers\TestingController::class, 'testing']);
    Route::post('sendnotif', [\App\Http\Controllers\TestingController::class, 'sendnotif'])->name('sendnotif');
    Route::post('bayar', [\App\Http\Controllers\TestingController::class, 'bayar'])->name('bayar');
    Route::post('usernotification', [\App\Http\Controllers\TestingController::class, 'usernotification'])->name('usernotification');
});
//Student
Route::middleware(['auth', 'student'])->group(function () {
    Route::get('student', [StudentController::class, 'index'])->name('student.index');
    Route::post('createstudent', [StudentController::class, 'store'])->name('student.store');
    Route::get('biodata', [StudentController::class, 'biodata'])->name('biodata.edit');
    Route::get('calon_siswa', [StudentController::class, 'isibiodata'])->name('isibiodata');
    Route::post('updatebiodata/{id}', [StudentController::class, 'updatebiodata'])->name('updatestudent');
    Route::get('editorangtua', [StudentController::class, 'editorangtua'])->name('editorangtua');
    Route::get('editsekolah', [StudentController::class, 'editsekolah'])->name('editsekolah');
    Route::post('updateayah/{id}', [StudentController::class, 'updateayah'])->name('updateayah');
    Route::post('updateibu/{id}', [StudentController::class, 'updateibu'])->name('updateibu');
    Route::post('updatefoto/{id}', [StudentController::class, 'updatefoto'])->name('updatefoto');
    Route::get('editbiodata', [StudentController::class, 'editbiodata'])->name('editbiodata');
    Route::post('savebiodata/{id}', [StudentController::class, 'savebiodata'])->name('savebiodata');
    //Payment
    Route::get('payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('pembayaran', [PaymentControllerAlias1::class, 'index'])->name('pembayaran.index');
    Route::post('uploadtp', [PaymentControllerAlias1::class, 'uploadtp'])->name('uploadtp');
    Route::post('create', [PaymentController::class, 'store'])->name('payment.create');
    Route::post('bayar/{id}', [PaymentController::class, 'bayar'])->name('payment.bayar');
    Route::post('checkout/{id}', [PaymentController::class, 'checkout'])->name('checkout');
    //Update Alamat
    Route::post('updatealamat/{uuid}', [StudentController::class, 'updatealamat'])->name('updatealamat');
    //Upload File
    Route::get('file', [StudentController::class, 'uploadfile'])->name('file');
    Route::post('uploadkk', [StudentController::class, 'uploadkk'])->name('uploadkk');
    Route::post('uploadakte', [StudentController::class, 'uploadakte'])->name('uploadakte');
    Route::post('uploadfoto', [StudentController::class, 'uploadfoto'])->name('uploadfoto');
    Route::get('createstudent', [StudentController::class, 'createstudent'])->name('createstudent');
});
Route::post('updatesekolah/{uuid}', [StudentController::class, 'updatesekolah'])->name('updatesekolah');
Route::get('printform/{id}', [PrintController::class, 'print'])->name('printform');
Route::delete('deletepayment/{id}', [PaymentControllerAlias::class, 'deletepayment'])->name('deletepayment');

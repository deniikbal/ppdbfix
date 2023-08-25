<?php

use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
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

//Route::get('home', [HomeController::class, 'index'])->name('home');
//Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
    //Users
    Route::get('users', [UserController::class, 'index'])->name('users.index');
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
    //WhatsApp
    Route::get('wa', [\App\Http\Controllers\WhatsAppController::class, 'index'])->name('wa.index');
    Route::post('wastore', [\App\Http\Controllers\WhatsAppController::class, 'wastore'])->name('wa.store');
    Route::post('deletewa/{id}', [\App\Http\Controllers\WhatsAppController::class, 'deletewa'])->name('deletewa');
    Route::post('waupdate/{id}', [\App\Http\Controllers\WhatsAppController::class, 'waupdate'])->name('waupdate');
    //PAYMENT
    Route::get('adminpayment', [\App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('adminpayment');

});
//Student
Route::middleware(['auth'])->group(function () {
    Route::get('student', [StudentController::class, 'index'])->name('student.index');
    Route::post('createstudent', [StudentController::class, 'store'])->name('student.store');
    Route::get('biodata', [StudentController::class, 'biodata'])->name('biodata.edit');
    Route::get('calon_siswa', [StudentController::class, 'isibiodata'])->name('isibiodata');
    Route::post('updatebiodata/{uuid}', [StudentController::class, 'updatebiodata'])->name('updatebiodata');
    Route::post('updatesekolah/{uuid}', [StudentController::class, 'updatesekolah'])->name('updatesekolah');
    Route::get('editorangtua', [StudentController::class, 'editorangtua'])->name('editorangtua');
    Route::get('editsekolah', [StudentController::class, 'editsekolah'])->name('editsekolah');
    Route::post('updateorangtua/{uuid}', [StudentController::class, 'updateorangtua'])->name('updateorangtua');
    Route::post('updatefoto/{id}', [StudentController::class, 'updatefoto'])->name('updatefoto');
    //Payment
    Route::get('payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('create', [PaymentController::class, 'store'])->name('payment.create');
    Route::post('bayar/{id}', [PaymentController::class, 'bayar'])->name('payment.bayar');
    Route::post('checkout/{id}', [PaymentController::class, 'checkout'])->name('checkout');
    //Update Alamat
    Route::post('updatealamat/{uuid}', [StudentController::class, 'updatealamat'])->name('updatealamat');
});

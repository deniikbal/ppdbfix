<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SchoolsController;
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

Route::get('home', [HomeController::class, 'index'])->name('home');
//Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
    //Users
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('user/{id}/edit', [UserController::class, 'show'])->name('users.show');
    Route::put('user/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('user/{id}', [UserController::class, 'delete'])->name('users.delete');
    Route::post('createusers', [UserController::class, 'store'])->name('users.store');
    Route::put('regisnewuser/{id}', [UserController::class, 'regisnewuser'])->name('regisnewuser');
    Route::get('import', [SchoolsController::class, 'import'])->name('import');
    Route::get('sekolah', [SchoolsController::class, 'index'])->name('schools.index');
});
//Student
Route::middleware(['auth'])->group(function () {
    Route::get('student', [StudentController::class, 'index'])->name('student.index');
    Route::post('createstudent', [StudentController::class, 'store'])->name('student.store');
    Route::get('biodata/{uuid}', [StudentController::class, 'biodata'])->name('biodata.edit');
    Route::post('updatebiodata/{uuid}', [StudentController::class, 'updatebiodata'])->name('updatebiodata');
    Route::post('updatesekolah/{uuid}', [StudentController::class, 'updatesekolah'])->name('updatesekolah');
    Route::get('editorangtua/{uuid}', [StudentController::class, 'editorangtua'])->name('editorangtua');
    Route::post('updateorangtua/{uuid}', [StudentController::class, 'updateorangtua'])->name('updateorangtua');
    //Payment
    Route::get('payment/{uuid}', [PaymentController::class, 'index'])->name('payment.index');
    Route::post('create', [PaymentController::class, 'store'])->name('payment.create');
    Route::post('bayar/{id}', [PaymentController::class, 'bayar'])->name('payment.bayar');
    Route::get('callback', [PaymentController::class, 'callback'])->name('callback');
});

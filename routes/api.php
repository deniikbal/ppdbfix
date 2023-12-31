<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\PaymentXenditController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', [UserController::class, 'index'])->name('users.index');

Route::get('provinces', [LocationController::class, 'provinces'])->name('api-provincies');
Route::get('regencies/{provinces_id}', [LocationController::class, 'regencies'])->name('api-regencies');
Route::get('districts/{regencys_id}', [LocationController::class, 'district'])->name('api-district');

Route::post('/checkout/callback', [PaymentController::class, 'callback'])->name('callback');

//Route::post('createinvoice', [PaymentXenditController::class, 'create'])->name('createinvoice');

Route::post('createinvoice', [PaymentXenditController::class, 'createinvoice'])->name('payment_xendit');
Route::post('callback', [PaymentXenditController::class, 'callback'])->name('callback');

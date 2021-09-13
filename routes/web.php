<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::post('/pay', [PaymentController::class, 'pay']);
Route::post('/handle', [PaymentController::class, 'handle']);
Route::post('/finish/{id?}', [PaymentController::class, 'finish']);
Route::post('/error', [PaymentController::class, 'error']);

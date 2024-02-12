<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayController;


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


Route::get('/home', function () {
    return view('home');
});

Route::get('/pay', [PayController::class,'pay']);
Route::get('/callback', function () {
    return 'suecss';
});
Route::get('/error', function () {
    return 'payment faild';
});



Route::get('/pay2', [PayController::class,'pay2']);
Route::get('hyperpay_pay', [PayController::class,'callback_hyperpay'])->name('hyperpay_pay');



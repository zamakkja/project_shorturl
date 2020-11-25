<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShortUrlController;


Route::get('/', function () {
    return view('index');
});
Route::get('/login', function () {
    return view('auth/login');
});
Route::get('/register', function () {
    return view('auth/register');
});

Route::get('/all_url', [ShortUrlController::class, 'getAll_URL'] );
Route::get('/getDetail/{code}', [ShortUrlController::class, 'getDetail'] );
Route::get('/{code}' , [ShortUrlController::class, 'CodeRedirect'] );
Route::post('/add_short' , [ShortUrlController::class, 'Add_ShortUrl'] );

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

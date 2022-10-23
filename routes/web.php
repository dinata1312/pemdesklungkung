<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FormController;
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

Route::get('/', [ HomeController::class, 'index' ])->name('landing');
Route::post('/sendMessage', [ HomeController::class, 'sendWA' ])->name('contactWA');

Route::group(['as' => 'notice.' , 'prefix' => 'pengumuman'], function () {
    Route::get('/', [ NoticeController::class, "index" ])->name('index');
    Route::get('/{slug}', [ NoticeController::class, "show" ])->name('show');
    Route::post('/{slug}/reply', [ NoticeController::class, "reply" ])->name('reply');
    Route::put('/{slug}/react', [ NoticeController::class, "react" ])->name('react');
});

Route::group(['as' => 'hero.' , 'prefix' => 'baner'], function () {
    Route::get('/', [ NoticeController::class, "index" ])->name('index');
    Route::get('/{slug}', [ NoticeController::class, "show" ])->name('show');
});

Route::group(['as' => 'page.' , 'prefix' => 'hal'], function () {
    Route::get('/', [ PageController::class, "index" ])->name('index');
    Route::get('/{slug}', [ PageController::class, "show" ])->name('show');
});
Route::group(['as' => 'product.' , 'prefix' => 'produk'], function () {
    Route::get('/', [ ProductController::class, "index" ])->name('index');
    Route::get('/{slug}', [ ProductController::class, "show" ])->name('show');
});

Route::group(['as' => 'form.', 'prefix' => 'form'], function () {
    Route::get('/{form_id}', [ FormController::class, 'public' ])->name('public');
    Route::post('/{form_id}', [ FormController::class, 'postResponse' ])->name('post');
});

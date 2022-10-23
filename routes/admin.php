<?php

namespace App\Http\Middleware;

use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\BlobController;
use App\Http\Controllers\Admin\NavigationController;
use App\Http\Controllers\Admin\PrivilageController;
use App\Http\Controllers\Admin\DynamicFormController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::group([ "middleware" => ['auth:sanctum', 'verified'] ], function() {
    Route::get('/', function () {return redirect(route('admin.dashboard'));});
    Route::view('/dashboard', "dashboard")->name('dashboard');

    Route::get('/user', [ UserController::class, "index" ])->name('user')->middleware('can:admin.user.read');
    Route::view('/user/new', "admin.user.user-new")->name('user.new')->middleware('can:admin.user.create');
    Route::get('/user/edit/{user_id}', [ UserController::class, "edit" ])->name('user.edit');

    Route::get('/tag', [ PostController::class, "tag" ])->name('tag')->middleware('can:admin.tag.read');
    Route::get('/pengumuman', [ PostController::class, "notice" ])->name('pengumuman')->middleware('can:admin.post.notice.read');
    Route::get('/halaman', [ PostController::class, "page" ])->name('halaman')->middleware('can:admin.post.page.read');
    Route::get('/banner', [ PostController::class, "hero" ])->name('banner')->middleware('can:admin.post.hero.read');
    Route::get('/produk', [ PostController::class, "product" ])->name('produk')->middleware('can:admin.post.product.read');

    Route::get('/file-manager', [ BlobController::class, "index" ])->name('file-manager')->middleware('can:admin.file-manager.read');
    Route::post('/file-manager', [ BlobController::class, "store" ])->name('file-manager.store');

    Route::get('/navigation', [ NavigationController::class, "index" ])->name('navigation')->middleware('can:admin.navigation.read');

    Route::get('/privilage/role', [ PrivilageController::class, "role" ])->name('privilage.role')->middleware('can:admin.privilage.role.read');
    Route::get('/privilage/permission', [ PrivilageController::class, "permission" ])->name('privilage.permission')->middleware('can:admin.privilage.perm.read');

    Route::prefix('form')->as('form.')->group(function () {
        Route::get('/', [ DynamicFormController::class, 'form'])->name('index');
        Route::get('/question', [ DynamicFormController::class, 'question' ])->name('question');
        Route::get('{form_slug}', [ DynamicFormController::class, 'formManage' ])->name('edit');
        Route::get('{form_slug}/response', [ DynamicFormController::class, 'formRespondent' ])->name('respondent');
        Route::get('{form_slug}/response/export', [ DynamicFormController::class, 'exportResponse' ])->name('export');
        Route::get('{form_slug}/response/{responden}', [ DynamicFormController::class, 'formResponse' ])->name('response');
    });

    Route::prefix('document')->as('document.')->group(function () {
        Route::get('/', [ DocumentController::class, "index" ])->name('index');
        Route::get('/new', [ DocumentController::class, "create" ])->name('new');
        Route::get('/edit/{document_id}', [ DocumentController::class, "edit" ])->name('edit');
        Route::get('/export/{document_id}', [ DocumentController::class, "export" ])->name('export');
        Route::get('/export/response/{responden}', [ DocumentController::class, "exportResponse" ])->name('export.response');
    });

    Route::prefix('setting')->as('setting.')->group(function () {
        Route::get('/', [ SettingController::class, "setting" ])->name('general');
        Route::get('/section', [ SettingController::class, "section" ])->name('section');
    });

});

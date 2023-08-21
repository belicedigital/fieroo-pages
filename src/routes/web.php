<?php
use Illuminate\Support\Facades\Route;
use Fieroo\Pages\Controllers\PagesController;

Route::group(['prefix' => 'admin'], function() {
    Route::resource('/pages', PagesController::class);
    Route::post('/page-toggle-status', [PagesController::class, 'changePublished']);
    Route::post('/summernote/uploadImg', [PagesController::class, 'uploadImg']);
    Route::get('/page/{pageSlug}', [PagesController::class, 'page']);
});
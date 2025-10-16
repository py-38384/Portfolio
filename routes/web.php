<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImageUploadController;

Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/portfolios', [SiteController::class, 'portfolios'])->name('portfolios');
Route::get('/portfolios/{id}', [SiteController::class, 'portfolios_details'])->name('portfolios.details');
Route::get('/blogs/{id}', [SiteController::class, 'blogs_details'])->name('blogs.details');
Route::get('/blogs', [SiteController::class, 'blogs'])->name('blogs');
Route::get('/test', [SiteController::class, 'test'])->name('test');

Route::post('/upload-image', [ImageUploadController::class, 'uploadFile']);
Route::post('/fetch-image', [ImageUploadController::class, 'uploadByUrl']);

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/dashboard', [BackendController::class, 'dashboard'])->name('dashboard');

    Route::name('projects.')->group(function (){
        Route::get('/projects', [BackendController::class, 'projects'])->name('index');
        Route::get('/projects/create', [BackendController::class, 'projects_create'])->name('create');
        Route::post('/projects/store', [BackendController::class, 'projects_store'])->name('store');
        Route::get('/projects/edit', [BackendController::class, 'projects_edit'])->name('edit');
        Route::put('/projects/update', [BackendController::class, 'projects_update'])->name('update');
        Route::put('/projects/delete', [BackendController::class, 'projects_delete'])->name('delete');
    });
    Route::name('blogs.')->group(function (){
        Route::get('/blogs', [BackendController::class, 'blogs'])->name('index');
        Route::get('/blogs/create', [BackendController::class, 'blogs_create'])->name('create');
        Route::post('/blogs/store', [BackendController::class, 'blogs_store'])->name('store');
        Route::get('/blogs/edit', [BackendController::class, 'blogs_edit'])->name('edit');
        Route::put('/blogs/update', [BackendController::class, 'blogs_update'])->name('update');
        Route::put('/blogs/delete', [BackendController::class, 'blogs_delete'])->name('delete');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

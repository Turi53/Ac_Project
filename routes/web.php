<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CarModController;
use App\Http\Controllers\Admin\DraftsCarModsController;
use App\Http\Controllers\Admin\DraftsTrackModsController;
use App\Http\Controllers\Admin\MakeController;
use App\Http\Controllers\Admin\PublishedCarModsController;
use App\Http\Controllers\Admin\PublishedModsController;
use App\Http\Controllers\Admin\PublishedTrackModsController;
use App\Http\Controllers\Admin\TrackModController;
use App\Http\Controllers\Admin\UnpublishedCarModsController;
use App\Http\Controllers\Admin\UnpublishedTrackModsController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Log In
Route::get('register/', [AuthController::class, 'showRegister'])->name('show-register');
Route::post('register/', [AuthController::class, 'register'])->name('register');
Route::get('login/', [AuthController::class, 'showLogin'])->name('show-login');
Route::post('login/', [AuthController::class, 'login'])->name('login');
Route::post('logout/', [AuthController::class, 'logout'])->name('logout');

// Admin
Route::middleware(['auth', 'admin'])->group(function() {
    Route::prefix('admin')->name('admin.')->group(function () {
        // Mods
        Route::post('/mods/{mod}/publish', [PublishedModsController::class, 'store'])->name('mods.publish');
        Route::post('/mods/{mod}/unpublish', [PublishedModsController::class, 'destroy'])->name('mods.unpublish');

        // Car Mods
        Route::get('car-mods/', [CarModController::class, 'index'])->name('car-mods.index');
        Route::get('car-mods/create', [CarModController::class, 'create'])->name('car-mods.create');
        Route::post('car-mods/', [CarModController::class, 'store'])->name('car-mods.store');
        Route::get('car-mods/{carMod}/edit', [CarModController::class, 'edit'])->name('car-mods.edit');
        Route::get('car-mods/{carMod}', [CarModController::class, 'show'])->name('car-mods.show');
        Route::put('car-mods/{carMod}', [CarModController::class, 'update'])->name('car-mods.update');
        Route::delete('car-mods/{carMod}', [CarModController::class, 'destroy'])->name('car-mods.destroy');

        Route::get('/published-car-mods', [PublishedCarModsController::class, 'index'])->name('published-car-mods.index');

        Route::get('/draft-car-mods', [DraftsCarModsController::class, 'index'])->name('draft-car-mods.index');;

        Route::get('/unpublished-car-mods', [UnpublishedCarModsController::class, 'index'])->name('unpublished-car-mods.index');

        // Track Mods
        Route::get('track-mods/', [TrackModController::class, 'index'])->name('track-mods.index');
        Route::get('track-mods/create', [TrackModController::class, 'create'])->name('track-mods.create');
        Route::post('track-mods/', [TrackModController::class, 'store'])->name('track-mods.store');
        Route::get('track-mods/{trackMod}/edit', [TrackModController::class, 'edit'])->name('track-mods.edit');
        Route::get('track-mods/{trackMod}', [TrackModController::class, 'show'])->name('track-mods.show');
        Route::put('track-mods/{trackMod}', [TrackModController::class, 'update'])->name('track-mods.update');
        Route::delete('track-mod/{trackMod}', [TrackModController::class, 'destroy'])->name('track-mods.destroy');

        Route::get('/published-track-mods', [PublishedTrackModsController::class, 'index'])->name('published-track-mods.index');

        Route::get('/draft-track-mods', [DraftsTrackModsController::class, 'index'])->name('draft-track-mods.index');;

        Route::get('/unpublished-track-mods', [UnpublishedTrackModsController::class, 'index'])->name('unpublished-track-mods.index');

        // Authors
        Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
        Route::get('/authors/create', [AuthorController::class, 'create'])->name('authors.create');
        Route::post('/authors/', [AuthorController::class, 'store'])->name('authors.store');
        Route::get('/authors/{author}', [AuthorController::class, 'edit'])->name('authors.edit');
        Route::put('/authors/{author}', [AuthorController::class, 'update'])->name('authors.update');
        Route::delete('/authors{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');

        // Makes
        Route::get('/makes', [MakeController::class, 'index'])->name('makes.index');
        Route::get('/makes/create', [MakeController::class, 'create'])->name('makes.create');
        Route::post('/makes/', [MakeController::class, 'store'])->name('makes.store');
        Route::get('/makes/{make}', [MakeController::class, 'edit'])->name('makes.edit');
        Route::put('/makes/{make}', [MakeController::class, 'update'])->name('makes.update');
        Route::delete('/makes{make}', [MakeController::class, 'destroy'])->name('makes.destroy');
    });

});

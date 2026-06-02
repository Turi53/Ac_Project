<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CarModController;
use App\Http\Controllers\Admin\DraftsCarModsController;
use App\Http\Controllers\Admin\DraftsTrackModsController;
use App\Http\Controllers\Admin\MakeController;
use App\Http\Controllers\Admin\PublishedCarModsController;
use App\Http\Controllers\Admin\PublishedTrackModsController;
use App\Http\Controllers\Admin\UnpublishedCarModsController;
use App\Http\Controllers\Admin\UnpublishedTrackModsController;
use App\Http\Controllers\TrackModController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Car Mods
    Route::get('car-mods/', [CarModController::class, 'index'])->name('car-mods.index');
    Route::get('car-mods/create', [CarModController::class, 'create'])->name('car-mods.create');
    Route::post('car-mods/', [CarModController::class, 'store'])->name('car-mods.store');
    Route::get('car-mods/{carMod}/edit', [CarModController::class, 'edit'])->name('car-mods.edit');
    Route::get('car-mods/{carMod}', [CarModController::class, 'show'])->name('car-mods.show');
    Route::put('car-mods/{carMod}', [CarModController::class, 'update'])->name('car-mods.update');
    Route::delete('car-mods/{carMod}', [CarModController::class, 'destroy'])->name('car-mods.destroy');

    Route::get('/published-car-mods', [PublishedCarModsController::class, 'index'])->name('published-car-mods.index');
    Route::post('/published-car-mods/{carMod}', [PublishedCarModsController::class, 'store'])->name('published-car-mods.store');
    Route::delete('/published-car-mods/{carMod}', [PublishedCarModsController::class, 'destroy'])->name('published-car-mods.destroy');

    Route::get('/draft-car-mods', [DraftsCarModsController::class, 'index'])->name('draft-car-mods.index');;

    Route::get('/unpublished-car-mods', [UnpublishedCarModsController::class, 'index'])->name('unpublished-car-mods.index');

    // Track Mods
    Route::get('track-mods/', [TrackModController::class, 'index'])->name('track-mods.index');
    Route::get('track-mods/', [TrackModController::class, 'create'])->name('track-mods.create');
    Route::post('track-mods/', [TrackModController::class, 'store'])->name('track-mods.store');
    Route::get('track-mods/{trackMod}', [TrackModController::class, 'edit'])->name('track-mods.edit');
    Route::get('track-mods/{trackMod}', [TrackModController::class, 'show'])->name('track-mods.show');
    Route::put('track-mods/{trackMod}', [TrackModController::class, 'update'])->name('track-mods.update');
    Route::delete('track-mod/{trackMod}', [TrackModController::class, 'destroy'])->name('track-mods.destroy');

    Route::get('/published-track-mods', [PublishedTrackModsController::class, 'index'])->name('published-track-mods.index');
    Route::post('/published-track-mods/{trackMod}', [PublishedTrackModsController::class, 'store'])->name('published-track-mods.store');
    Route::delete('/published-track-mods/{trackMod}', [PublishedTrackModsController::class, 'destroy'])->name('published-track-mods.destroy');

    Route::get('/draft-track-mods', [DraftsTrackModsController::class, 'index'])->name('draft-track-mods.index');;

    Route::get('/unpublished-track-mods', [UnpublishedTrackModsController::class, 'index'])->name('unpublished-track-mods.index');

    // Authors
    Route::get('/authors', [AuthorController::class, 'index'])->name('author.index');
    Route::get('/authors', [AuthorController::class, 'create'])->name('author.create');
    Route::post('/authors/', [AuthorController::class, 'store'])->name('author.store');
    Route::get('/authors/{Author}', [AuthorController::class, 'edit'])->name('author.edit');
    Route::put('/authors/{Author}', [AuthorController::class, 'update'])->name('author.update');
    Route::delete('/authors{Author}', [AuthorController::class, 'destroy'])->name('author.destroy');

    // Makes
    Route::get('/makes', [MakeController::class, 'index'])->name('make.index');
    Route::get('/makes', [MakeController::class, 'create'])->name('make.create');
    Route::post('/makes/', [MakeController::class, 'store'])->name('makes.store');
    Route::get('/makes/{Make}', [MakeController::class, 'edit'])->name('make.edit');
    Route::put('/makes/{Make}', [MakeController::class, 'update'])->name('make.update');
    Route::delete('/makes{Make}', [MakeController::class, 'destroy'])->name('make.destroy');
});

<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublisherController;
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
    return redirect()->route('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    //authors
    Route::prefix('authors')->group(function () {
        Route::get('/',[AuthorController::class,'index'])->name('authors.index');
        Route::get('/create',[AuthorController::class,'create'])->name('authors.create');
        Route::post('/store',[AuthorController::class,'store'])->name('authors.store');
        Route::get('/edit/{id}',[AuthorController::class,'edit'])->name('authors.edit');
        Route::post('/update/{id}',[AuthorController::class,'update'])->name('authors.update');
        Route::get('/delete/{id}',[AuthorController::class,'delete'])->name('authors.delete');
    });
    //publishers
    Route::prefix('publishers')->group(function () {
        Route::get('/',[PublisherController::class,'index'])->name('publishers.index');
        Route::get('/create',[PublisherController::class,'create'])->name('publishers.create');
        Route::post('/store',[PublisherController::class,'store'])->name('publishers.store');
        Route::get('/edit/{id}',[PublisherController::class,'edit'])->name('publishers.edit');
        Route::post('/update/{id}',[PublisherController::class,'update'])->name('publishers.update');
        Route::get('/delete/{id}',[PublisherController::class,'delete'])->name('publishers.delete');
    });
    //categories
    Route::prefix('categories')->group(function () {
        Route::get('/',[CategoryController::class,'index'])->name('categories.index');
        Route::get('/create',[CategoryController::class,'create'])->name('categories.create');
        Route::post('/store',[CategoryController::class,'store'])->name('categories.store');
        Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('categories.edit');
        Route::post('/update/{id}',[CategoryController::class,'update'])->name('categories.update');
        Route::get('/delete/{id}',[CategoryController::class,'delete'])->name('categories.delete');
    });
    //books
    Route::prefix('books')->group(function () {
        Route::get('/',[BookController::class,'index'])->name('books.index');
        Route::get('/create',[BookController::class,'create'])->name('books.create');
        Route::post('/store',[BookController::class,'store'])->name('books.store');
        Route::get('/edit/{id}',[BookController::class,'edit'])->name('books.edit');
        Route::post('/update/{id}',[BookController::class,'update'])->name('books.update');
        Route::get('/delete/{id}',[BookController::class,'delete'])->name('books.delete');
    });
});

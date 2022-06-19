<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookIssueController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\UserBookReqController;
use App\Http\Controllers\UserRequestController;
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
//login controller
Route::post('/login', [LoginController::class, 'verify'])->name('custom.verify');
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
        Route::get('/', [AuthorController::class, 'index'])->name('authors.index');
        Route::group(['middleware' => 'isAdmin'], function () {
            Route::get('/create', [AuthorController::class, 'create'])->name('authors.create');
            Route::post('/store', [AuthorController::class, 'store'])->name('authors.store');
            Route::get('/edit/{id}', [AuthorController::class, 'edit'])->name('authors.edit');
            Route::post('/update/{id}', [AuthorController::class, 'update'])->name('authors.update');
            Route::get('/delete/{id}', [AuthorController::class, 'delete'])->name('authors.delete');
        });
    });
    //publishers
    Route::prefix('publishers')->group(function () {
        Route::get('/', [PublisherController::class, 'index'])->name('publishers.index');
        Route::group(['middleware' => 'isAdmin'], function () {
            Route::get('/create', [PublisherController::class, 'create'])->name('publishers.create');
            Route::post('/store', [PublisherController::class, 'store'])->name('publishers.store');
            Route::get('/edit/{id}', [PublisherController::class, 'edit'])->name('publishers.edit');
            Route::post('/update/{id}', [PublisherController::class, 'update'])->name('publishers.update');
            Route::get('/delete/{id}', [PublisherController::class, 'delete'])->name('publishers.delete');
        });
    });
    //categories
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::group(['middleware' => 'isAdmin'], function () {
            Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::post('/update/{id}', [CategoryController::class, 'update'])->name('categories.update');
            Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');
        });
    });
    //books
    Route::prefix('books')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('books.index');
        Route::group(['middleware' => 'isAdmin'], function () {
            Route::get('/create', [BookController::class, 'create'])->name('books.create');
            Route::post('/store', [BookController::class, 'store'])->name('books.store');
            Route::get('/edit/{id}', [BookController::class, 'edit'])->name('books.edit');
            Route::post('/update/{id}', [BookController::class, 'update'])->name('books.update');
            Route::get('/delete/{id}', [BookController::class, 'delete'])->name('books.delete');
        });
    });
    // user requests
    Route::prefix('user-requests')->middleware('isAdmin')->group(function () {
        Route::get('/', [UserRequestController::class, 'index'])->name('user-requests.index');
        Route::group(['middleware' => 'isAdmin'], function () {
            Route::get('/approve/{id}', [UserRequestController::class, 'approve'])->name('user-requests.approve');
            Route::get('/reject/{id}', [UserRequestController::class, 'reject'])->name('user-requests.reject');
            Route::get('approved-requests', [UserRequestController::class, 'approved'])->name('user-requests.approved');
            Route::get('rejected-requests', [UserRequestController::class, 'rejected'])->name('user-requests.rejected');
        });
    });
    // books issue requests
    Route::prefix('book-issue')->middleware('isAdmin')->group(function () {
        Route::get('/', [BookIssueController::class, 'index'])->name('book-issue.index');
        Route::group(['middleware' => 'isAdmin'], function () {
            Route::get('/approve/{id}', [BookIssueController::class, 'approve'])->name('book-issue.approve');
            Route::get('/reject/{id}', [BookIssueController::class, 'reject'])->name('book-issue.reject');
            Route::get('approved-requests', [BookIssueController::class, 'approved'])->name('book-issue.approved');
            Route::get('rejected-requests', [BookIssueController::class, 'rejected'])->name('book-issue.rejected');
            Route::get('/edit/{id}',[BookIssueController::class,'edit'])->name('book-issue.edit');
        });
    });
    // user book requests
    Route::prefix('user-book-requests')->group(function () {
        Route::get('/', [UserBookReqController::class, 'index'])->name('user-book-requests.index');
        Route::get('/create', [UserBookReqController::class, 'create'])->name('user-book-requests.create');
        Route::post('/store/{user_id}', [UserBookReqController::class, 'store'])->name('user-book-requests.store');
    });
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\library\LibraryController;
use App\Http\Controllers\library\BookController;
use App\Http\Controllers\library\BorrowController;

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
    return view('welcome');
});

Auth::routes();




Route::group(["middleware" => ["auth"]], function() {

    Route::resource('library', LibraryController::class);
    Route::resource('book',BookController::class);
    Route::get('book/{book}/details', [BookController::class, 'details'])->name('book.details.add');
    Route::post('/book/details', [BookController::class, 'bookDetails_store'])->name('book.details');
    Route::get('book/{book}/informations', [BookController::class, 'views'])->name('book.details.view');
    Route::get('/book/test/demo', [BookController::class, 'test'])->name('book.test.demo');
        
   });

Route::resource('borrow',BorrowController::class);
Route::get('borrow/books/{borrow}/books',[BorrowController::class, 'getBooks'])->name('borrow.get.books');
Route::get('borrow/student/{student_id}/details',[BorrowController::class, 'student_details'])->name('borrow.get.students');
Route::get('borrow/student/{student}/reload',[BorrowController::class, 'index'])->name('borrow.reload.students');

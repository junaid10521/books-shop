<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PublisherController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//  Books Api's
Route::get('allBooks', [BookController::class, 'index']);
Route::get('searchBooks', [BookController::class, 'searchBookByName']);


//  Authors Api's
Route::get('allAuthors', [AuthorController::class, 'index']);


// Publisher Api's
Route::get('publishers', [PublisherController::class, 'index']);


//  Prices Api's





Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



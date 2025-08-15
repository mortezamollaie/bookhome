<?php

use App\Http\Controllers\AssignAuthorsToBookController;
use App\Http\Controllers\AssignBooksToAuthorController;
use App\Http\Controllers\ReviewController;
use App\Http\Requests\AssignBooksToAuthorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

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

// Auth routes
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/books', BookController::class);
    Route::post('/books/assign-authors', AssignAuthorsToBookController::class);
    Route::apiResource('/authors', AuthorController::class);
    Route::post('/authors/assign-books', AssignBooksToAuthorController::class);
    Route::get('/reviews', [ReviewController::class, 'allReviews']);
    Route::post('/reviews/create', [ReviewController::class, 'createReview']);
    Route::delete('/reviews/delete/{review_id}', [ReviewController::class, 'deleteReview']);
});

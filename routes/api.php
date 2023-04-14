<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BatalyonController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserBatalyonController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Default Route Laravel

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Routes for Auth Login/Register
Route::post('/v1/auth/login', [AuthController::class, 'login']);
Route::post('/v1/auth/register', [AuthController::class, 'register']);


// Grouping Route for Middleware auth sanctum
Route::middleware(['auth:sanctum'])->group(function () {
    // Route with middleware for Auth User
    Route::get('/v1/auth/account/me', [AuthController::class, 'me']); // check user logged in
    Route::get('/v1/auth/logout', [AuthController::class, 'logout']); // logout and revoke token

    // Route with middleware for News
    Route::post('/v1/news', [NewsController::class, 'store']); // Route for Create new data news
    Route::patch('/v1/news/{id}', [NewsController::class, 'update'])->middleware('news-author'); // Route for Update data news
    Route::delete('/v1/news/{id}', [NewsController::class, 'destroy'])->middleware('news-author'); // Route for Delete data news

    // Route with middleware for Program
    Route::post('/v1/programs', [ProgramController::class, 'store']);
    Route::patch('/v1/program/{id}', [ProgramController::class, 'update']);
    Route::delete('/v1/program/{id}', [ProgramController::class, 'destroy']);

    // Route with middleware for Categories
    Route::post('/v1/categories', [CategoriesController::class, 'store']);
    Route::patch('/v1/category/{id}', [CategoriesController::class, 'update']);
    Route::delete('/v1/category/{id}', [CategoriesController::class, 'destroy']);

    // Route with middleware for Batalyon
    Route::post('/v1/batalyons', [BatalyonController::class, 'store']);
    Route::patch('/v1/batalyon/{id}', [BatalyonController::class, 'update']);
    Route::delete('/v1/batalyon/{id}', [BatalyonController::class, 'destroy']);

    // Route with middleware for user_batalyons
    Route::post('/v1/user/batalyons', [UserBatalyonController::class, 'store']);
    Route::patch('/v1/user/batalyon/{id}', [UserBatalyonController::class, 'update']);
    Route::delete('/v1/user/batalyon/{id}', [UserBatalyonController::class, 'destroy']);

    // Route with middleware for Report
    Route::post('/v1/omg-jatim/reports', [ReportController::class, 'store']);
    Route::patch('/v1/omg-jatim/report/{id}', [ReportController::class, 'update']);
    Route::delete('/v1/omg-jatim/report/{id}', [ReportController::class, 'destroy']);
});


// Routes for User
Route::get('/v1/users', [UserController::class, 'index']);


// Routes for News
Route::get('/v1/news', [NewsController::class, 'index']); // Route for get all Data News
Route::get('/v1/news/{id}', [NewsController::class, 'show']); // Route for get specified Data News by ID

// Routes for Category
Route::get('/v1/categories', [CategoriesController::class, 'index']);
Route::get('/v1/category/{id}', [CategoriesController::class, 'show']);

// // Route for Programs
Route::get('/v1/programs', [ProgramController::class, 'index']);
Route::get('/v1/program/{id}', [ProgramController::class, 'show']);

// Route for Batalyon
Route::get('/v1/batalyons', [BatalyonController::class, 'index']);
Route::get('/v1/batalyon/{id}', [BatalyonController::class, 'show']);

// Route for UserBatalyon
Route::get('/v1/user/batalyons', [UserBatalyonController::class, 'index']);
Route::get('/v1/user/batalyon/{id}', [UserBatalyonController::class, 'show']);

// Route for Reports
Route::get('/v1/omg-jatim/reports', [ReportController::class, 'index']);
Route::get('/v1/omg-jatim/report/{id}', [ReportController::class, 'show']);

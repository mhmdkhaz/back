<?php


use App\Http\Controllers\PortfolioController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get("/getProject" , [PortfolioController::class , 'get_all_project']);
Route::post("/createProject" , [PortfolioController::class , 'add_project']);
Route::delete('/deleteProject/{id}', [PortfolioController::class, 'deleteProject']);
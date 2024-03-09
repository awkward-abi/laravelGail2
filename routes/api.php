<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
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
use Illuminate\Routing\Router;



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/category', function () {
//     $categories = DB::table('categories')->get();
//     return response()->json($categories);
// });

Route::get('/category', [CategoryController::class, 'index']);

// Route::resource('category',App\Http\Controllers\CategoryController::class)->only(['index','store','show','update','destroy']);

Route::post('/category/add', [CategoryController::class,'store']);
Route::get('/category/getCategoryTitle', [CategoryController::class,'getCategoryTitle']);
Route::get('/category/getCategoryTitle{category.parent_id}', [CategoryController::class,'getCategoryTitle']);

Route::delete('/category/delete/{id}', [CategoryController::class,'destroy']);

Route::put('/category/edit/{id}', [CategoryController::class,'update']);

//Route::post('catgegory/add', [CategoryController::class,'store']);
//Route::get('category/{id}', [CategoryController::class,'show']);
Route::get('category/edit/{id}', [CategoryController::class,'edit']);

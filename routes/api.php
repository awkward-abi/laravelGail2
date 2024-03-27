<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
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


Route::get('/category', [CategoryController::class, 'index']);
Route::post('/category/add', [CategoryController::class,'store']);
Route::get('/category/getCategoryTitle', [CategoryController::class,'getCategoryTitle']);
Route::get('/category/getCategoryTitle{category.parent_id}', [CategoryController::class,'getCategoryTitle']);
Route::delete('/category/delete/{id}', [CategoryController::class,'destroy']);
Route::put('/category/edit/{id}', [CategoryController::class,'update']);
Route::get('category/edit/{id}', [CategoryController::class,'edit']);


Route::get('/category/{id}/subcategory', [SubCategoryController::class,'show']);
Route::delete('/subcategory/{id}', [SubCategoryController::class,'destroy']);




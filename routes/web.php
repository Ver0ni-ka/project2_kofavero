<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArchitectController;
use App\Http\Controllers\StyleController;
use App\Http\Controllers\DataController; 
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuildingController;



Route::get('/', [HomeController::class, 'index']);
Route::get('/architects', [ArchitectController::class, 'list']);
Route::get('/architects/create', [ArchitectController::class, 'create']);
Route::post('/architects/put', [ArchitectController::class, 'put']);

Route::get('/architects/update/{architect}', [ArchitectController::class, 'update']);
Route::post('/architects/patch/{architect}', [ArchitectController::class, 'patch']);

Route::post('/architects/delete/{architect}', [ArchitectController::class, 'delete']);
// Auth routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth', [AuthController::class, 'authenticate']);
Route::get('/logout', [AuthController::class, 'logout']);

// Book routes
Route::get('/buildings', [BuildingController::class, 'list']);
Route::get('/buildings/create', [BuildingController::class, 'create']);
Route::post('/buildings/put', [BuildingController::class, 'put']);
Route::get('/buildings/update/{building}', [BuildingController::class, 'update']);
Route::post('/buildings/patch/{building}', [BuildingController::class, 'patch']);
Route::post('/buildings/delete/{building}', [BuildingController::class, 'delete']);


Route::get('/styles', [StyleController::class, 'list']);
Route::get('/styles/create', [StyleController::class, 'create']);
Route::post('/styles/put', [StyleController::class, 'put']);

Route::get('/styles/update/{style}', [StyleController::class, 'update']);
Route::post('/styles/patch/{style}', [StyleController::class, 'patch']);

Route::post('/styles/delete/{style}', [StyleController::class, 'delete']);


// Data/API 
Route::get('/data/get-top-buildings', [DataController::class, 'getTopBuildings']); 
Route::get('/data/get-building/{building}', [DataController::class, 'getBuilding']); 
Route::get('/data/get-related-buildings/{building}', [DataController::class, 'getRelatedBuildings']); 



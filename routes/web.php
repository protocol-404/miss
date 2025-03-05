<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\testMiddleware;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [ProductController::class, 'index'])->middleware(testMiddleware::class);
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'signin']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::delete('/delete/{product:id}', [ProductController::class, 'destroy']);

Route::get('/form', [ProductController::class, 'create']);
Route::post('/form', [ProductController::class, 'store']);

Route::get('/register', [AuthController::class, 'show']);
Route::post('/register', [AuthController::class, 'register']);


Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/update/{product}', [ProductController::class, 'update'])->name('product.update');



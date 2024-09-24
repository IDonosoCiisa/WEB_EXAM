<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Middleware\ApiKeyMiddleware;
use Illuminate\Support\Facades\Route;

Route::apiResource('usuarios', UsuarioController::class)->middleware(ApiKeyMiddleware::class);
Route::apiResource('productos', ProductoController::class)->middleware(ApiKeyMiddleware::class);
Route::apiResource('clientes', ClienteController::class)->middleware(ApiKeyMiddleware::class);
